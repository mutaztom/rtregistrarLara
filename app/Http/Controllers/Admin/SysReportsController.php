<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tblregistrant;
use App\Reports\FeesReport;
use App\Reports\OrdersPaid;
use App\Reports\RegisterRequestReport;
use App\Reports\RegistrantsReport;
use ArPHP\I18N\Arabic;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SysReportsController extends Controller
{
    protected $reportlist = ['fees', 'registrants', 'orders', 'paidorders', 'testview'];

    protected $periodtype = ['Daily', 'Weekly', 'Monthly', 'FirstQuarter', 'SecondQuarter', 'ThirdQuarter', 'FourthQuarter', 'Annual'];

    protected $registrants;

    protected $period;

    protected int $month;

    protected int $year;

    protected $startdate;

    protected $enddate;

    protected $filter;

    public function __construct()
    {
        $this->registrants = Tblregistrant::select()->take(25)->get();
        $this->startdate = $this->startdate ?: Carbon::now();
        $this->enddate = $this->enddate ?: Carbon::now();
        $this->year = $this->startdate->year;
        $this->month = ($this->startdate->month);
    }

    public function index()
    {
        return view('admin.reports', ['reportlist' => $this->reportlist,
            'periodtype' => $this->periodtype, 'year' => $this->year,
            'period' => $this->period,
            'month' => $this->month]);
    }

    public function printReport(string $repname)
    {
        if ($repname == 'testview') {
            return view('registrants', ['registrants' => $this->registrants, 'title' => 'Registrants']);
        } else {
            $report = new FeesReport;
            $report = $this->getReport($repname);
            $report->run();

            return view('report', ['report' => $report]);
        }
    }

    public function exportReport(string $repname, bool $download)
    {
        //export report to pdf
        ini_set('memory_limit', '256M');
        Pdf::setOptions(['defaultFont' => 'dejavu-sans']);
        $report = $this->getReport($repname);

        if ($repname == 'testview') {
            $pdf = Pdf::loadHtml($this->fixArabic($report))
                ->setPaper('a4', 'landscape');
        } else {
            $repHtml = $this->printReport($repname)->render();
            $pdf = Pdf::loadHtml($this->fixArabic($repHtml))->setPaper('a4', 'landscape');
        }
        if ($download) {
            //$pdf = Pdf::loadHtml($this->fixArabic($re))->setPaper('a4', 'landscape');
            return $pdf->download($repname.'.pdf');
        } else {
            return $pdf->stream();
        }
    }

    public function filterReport(Request $request)
    {
        //filter report based on date range
        $this->month = ($request->get('month') ?: Carbon::now()->month());
        $this->year = $request->get('year') ?: Carbon::now()->year();
        $this->period = $request->get('period');
        $this->applyFilter($this->period);
        $filter = "$this->period Report, ("
                .$this->startdate->format('d/m/Y')
                .' to '.$this->enddate->format('d/m/Y').')';
        $this->filter = $filter;
        if (str_starts_with($request->get('command'), 'print')) {
            $rname = explode('_', $request->get('command'))[1];

            return $this->printReport($rname);
        } elseif (str_starts_with($request->get('command'), 'export')) {
            $rname = explode('_', $request->get('command'))[1];

            return $this->exportReport($rname,false);
        } elseif (str_starts_with($request->get('command'), 'download')) {
            $rname = explode('_', $request->get('command'))[1];

            return $this->exportReport($rname,true);
        }

        return redirect()->back()->withInput()->with('filter', $filter);
    }

    protected function applyFilter(string $period)
    {
        switch ($this->period) {
            case 'Daily':
                $this->startdate = Carbon::today();
                $this->enddate = $this->startdate->addDay(1);
                break;
            case 'Weekly':
                $this->enddate = Carbon::today();
                $this->startdate = $this->enddate->subDays(7);
                break;
            case 'Monthly':
                $this->enddate = Carbon::create($this->year, $this->month, 1)
                    ->endOfMonth();
                $this->startdate = $this->enddate->startOfMonth();
                break;
            case 'FirstQuarter':
                $this->startdate = Carbon::create($this->year, 1, 1);
                $this->enddate = Carbon::create($this->year, 3, 30)->endOfMonth();
                break;
            case 'SecondQuarter':
                $this->startdate = Carbon::create($this->year, 4, 1)->startOfMonth();
                $this->enddate = Carbon::create($this->year, 6, 1)->endOfMonth();
                break;
            case 'ThirdQuarter':
                $this->startdate = Carbon::create($this->year, 7, 1);
                $this->enddate = Carbon::create($this->year, 9, 1)->endOfMonth();
                break;
            case 'FourthQuarter':
                $this->startdate = Carbon::create($this->year, 10, 1);
                $this->enddate = Carbon::create($this->year, 12, 1)->endOfMonth();
                break;
            case 'Annual':
                $this->startdate = Carbon::create($this->year, 1, 1);
                $this->enddate = Carbon::create($this->year, 12)->endOfMonth();
                break;
            default:
                $this->startdate = Carbon::now()->format('Y-m-d');
                $this->enddate = Carbon::now()->format('Y-m-d');
                break;
        }

    }

    protected function getReport(string $repname)
    {
        $report = new FeesReport;
        if ($repname === 'fees') {
            $report = new FeesReport;
        } elseif ($repname == 'registrants') {
            $report = new RegistrantsReport(['startdate' => $this->startdate,
                'enddate' => $this->enddate, 'filter' => $this->filter]);
        } elseif ($repname == 'orders') {
            $report = new RegisterRequestReport(['startdate' => $this->startdate,
                'filter' => $this->filter, 'enddate' => $this->enddate]);
        }elseif($repname=='paidorders') {
            $report = new OrdersPaid(['startdate' => $this->startdate,
                'filter' => $this->filter, 'enddate' => $this->enddate, 'paid' => true]);
        }
        elseif ($repname == 'testview') {
            $report = view('registrants', ['registrants' => $this->registrants, 'title' => 'Registrants'])->render();
        }

        return $report;
    }

    protected function fixArabic(string $reportHtml)
    {
        // Arabic encode
        $arabic = new Arabic;
        $fixedHtml = '';
        $p = $arabic->arIdentify($reportHtml);
        for ($i = count($p) - 1; $i >= 0; $i -= 2) {
            $utf8ar = $arabic->utf8Glyphs(substr($reportHtml, $p[$i - 1], $p[$i] - $p[$i - 1]));
            $fixedHtml = substr_replace($reportHtml, $utf8ar, $p[$i - 1], $p[$i] - $p[$i - 1]);
        }

        //dd($reportHtml);
        return $fixedHtml;
    }
}
