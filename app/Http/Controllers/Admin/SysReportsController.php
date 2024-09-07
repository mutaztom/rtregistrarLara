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

    protected $registrants;

    protected $period;

    protected $startdate;

    protected $enddate;

    protected $filter;

    public function __construct()
    {
        $this->registrants = Tblregistrant::select()->take(25)->get();
        $this->startdate = Carbon::now();
        $this->enddate = Carbon::now();
    }

    public function index()
    {

        return view('admin.reports', ['reportlist' => $this->reportlist, 'filter' => $this->filter]);
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
        $this->month = $request->get('month');
        $this->year = $request->get('year');
        $this->period = $request->get('period');
        switch ($this->period) {
            case 'daily':
                $this->startdate = Carbon::now()->format('Y-m-d');
                $this->enddate = Carbon::now()->format('Y-m-d');
                //apply filter to query string
                $this->filter = ['ondate' => $this->startdate];
                break;
            case 'weekly':
                $this->startdate = Carbon::now()->format('Y-m-d');
                $this->enddate = Carbon::now()->subDays(7)->format('Y-m-d');
                break;
            case 'monthly':
                $this->startdate = Carbon::now()->startOfMonth()->format('Y-m-d');
                $this->enddate = Carbon::now()->endOfMonth()->format('Y-m-d');
                break;
            case 'firstquarter':
                $this->startdate = Carbon::now() - subQuarter(1)->format('Y-m-d');
                $this->enddate = Carbon::now()->subQuarter(1)->format('Y-m-d');
                break;
            case 'secondquarter':
                $this->startdate = Carbon::now()->subMonths(3)->startOfMonth()->format('Y-m-d');
                $this->enddate = Carbon::now()->subMonths(3)->endOfMonth()->format('Y-m-d');
                break;
            case 'thirdquarter':
                $this->startdate = Carbon::now()->subMonths(6)->startOfMonth()->format('Y-m-d');
                $this->enddate = Carbon::now()->subMonths(6)->endOfMonth()->format('Y-m-d');
                break;
            case 'fourthquarter':
                $this->startdate = Carbon::now()->subMonths(9)->startOfMonth()->format('Y-m-d');
                $this->enddate = Carbon::now()->subMonths(9)->endOfMonth()->format('Y-m-d');
                break;
            case 'yearly':
                $this->startdate = new Carbon('first day of January 2017');
                $this->enddate = $this->startdate->endOfYear()->format('Y-m-d');
                break;
            default:
                $this->startdate = Carbon::now()->format('Y-m-d');
                $this->enddate = Carbon::now()->format('Y-m-d');
                break;
        }
        $filter = "ondate between $this->startdate and $this->enddate";

        return view('admin.reports', ['reportlist' => $this->reportlist, 'filter' => $filter]);
    }

    protected function getReport(string $repname)
    {
        $report = new FeesReport;
        if ($repname === 'fees') {
            $report = new FeesReport;
        } elseif ($repname == 'registrants') {
            $report = new RegistrantsReport(['startdate' => $this->startdate, 'enddate' => $this->enddate]);
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
