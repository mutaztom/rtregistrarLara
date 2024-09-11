<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tblregistrant;
use App\Reports\FeesReport;
use App\Reports\RegisterRequestReport;
use App\Reports\RegistrantsReport;
use ArPHP\I18N\Arabic;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SysReportsController extends Controller
{
    protected $reportlist = ['fees', 'registrants', 'orders', 'paiedorders', 'testview'];

    protected $periodtype = ['Daily', 'Weekly', 'Monthly', 'FirstQuarter', 'SecondQuarter', 'ThirdQuarter', 'FourthQuarter', 'Annual'];

    protected $registrants;

    protected  $period;

    protected $startdate;

    protected  $enddate;

    protected  $filter;

    public function __construct()
    {
        $this->registrants = Tblregistrant::select()->take(25)->get();
        $this->startdate = Carbon::now();
        $this->enddate = Carbon::now();
    }

    public function index()
    {

        return view('admin.reports', ['reportlist' => $this->reportlist,
            'filter' => $this->filter, 'periodtype' => $this->periodtype]);
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

    public function exportReport(string $repname)
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
            $pdf = Pdf::loadHtml($repHtml)->setPaper('a4', 'landscape');
        }

        return $pdf->stream();
    }

    public function downloadReport(string $repname)
    {
        //export report to pdf

        $report = $this->getReport($repname);
        if ($repname != 'testview') {
            $report->run();
            $repHtml = view('report', ['report' => $report])->render();
            $pdf = Pdf::loadHtml($this->fixArabic($repHtml))->setPaper('a4', 'landscape');
        } else {
            $report = $this->printReport($repname);
            $pdf = Pdf::loadHtml($this->fixArabic($report))->setPaper('a4', 'landscape');
        }

        return $pdf->download($repname.'.pdf');
    }

    public function filterReport(Request $request)
    {
        //filter report based on date range
        $this->month = $request->get('month') ?: Carbon::now()->month();
        $this->year = $request->get('year') ?: Carbon::now()->year();
        $this->period = $request->get('period');
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
                $this->enddate = Carbon::create($this->year, $this->month, 1, 0)->endOfMonth();
                $this->startdate = $this->enddate->startOfMonth();
                break;
            case 'FirstQuarter':
                $this->startdate = Carbon::now() -> subQuarter(1)->format('Y-m-d');
                $this->enddate = Carbon::now()->subQuarter(1)->format('Y-m-d');
                break;
            case 'SecondQuarter':
                $this->startdate = Carbon::now()->subMonths(3)->startOfMonth()->format('Y-m-d');
                $this->enddate = Carbon::now()->subMonths(3)->endOfMonth()->format('Y-m-d');
                break;
            case 'ThirdQuarter':
                $this->startdate = Carbon::now()->subMonths(6)->startOfMonth()->format('Y-m-d');
                $this->enddate = Carbon::now()->subMonths(6)->endOfMonth()->format('Y-m-d');
                break;
            case 'FourthQuarter':
                $this->startdate = Carbon::now()->subMonths(9)->startOfMonth()->format('Y-m-d');
                $this->enddate = Carbon::now()->subMonths(9)->endOfMonth()->format('Y-m-d');
                break;
            case 'Annual':
                $this->startdate = new Carbon('first day of January 2017');
                $this->enddate = $this->startdate->endOfYear()->format('Y-m-d');
                break;
            default:
                $this->startdate = Carbon::now()->format('Y-m-d');
                $this->enddate = Carbon::now()->format('Y-m-d');
                break;
        }
        $this->filter = "perid: $this->period, ondate between $this->startdate->format('d-m-Y') 
        and $this->enddate->format('d-m-Y')";

        return redirect()->back();
    }

    protected function getReport(string $repname)
    {
        $report = new FeesReport;
        if ($repname === 'fees') {
            $report = new FeesReport;
        } elseif ($repname == 'registrants') {
            $report = new RegistrantsReport(['startdate' => $this->startdate,
                'enddate' => $this->enddate, 'filter' => $this->filter]);
            if ($this->filter != null) {
                $report->params = $this->filter;
            }
        } elseif ($repname == 'orders') {
            $report = new RegisterRequestReport;
        } elseif ($repname == 'testview') {
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
