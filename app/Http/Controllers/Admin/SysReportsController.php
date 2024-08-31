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

    protected $filter;

    public function __construct()
    {
        $this->registrants = Tblregistrant::select()->take(25)->get();
    }

    public function index()
    {

        return view('admin.reports', ['reportlist' => $this->reportlist]);
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
        $report = $this->getReport($repname);
        Pdf::setOption(['defautFont' => 'amiri']);

        if ($repname == 'testview') {
            $pdf = Pdf::loadHtml($this->fixArabic($report))
                ->setPaper('a4', 'landscape');
        } else {
            $report->run();
            $pdf = Pdf::loadView('report', ['report' => $report])
                ->setPaper('a4', 'portrait');
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
            $pdf = Pdf::loadHtml($this->fixArabic($report))->setPaper('a4', 'landscape');
        }

        return $pdf->download($repname.'.pdf');
    }

    public function filterReport(Request $request)
    {
        //filter report based on date range
        $month = $request->get('month');
        $year = $request->get('year');
        $this->period = $request->get('period');
        switch ($this->period) {
            case 'daily':
                $startdate = Carbon::now()->format('Y-m-d');
                $enddate = Carbon::now()->format('Y-m-d');
                //apply filter to query string
                $this->filter = ['ondate' => $startdate];
                break;
            case 'lastyear':
                $startdate = Carbon::now()->subYear()->startOfYear()->format('Y-m-d');
                $enddate = Carbon::now()->subYear()->endOfYear()->format('Y-m-d');
                break;
            case 'month':
                $startdate = Carbon::now()->startOfMonth()->format('Y-m-d');
                $enddate = Carbon::now()->endOfMonth()->format('Y-m-d');
                break;
            case 'lastmonth':
                $startdate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
                $enddate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
                break;
            default:
                $startdate = Carbon::now()->format('Y-m-d');
                $enddate = Carbon::now()->format('Y-m-d');
                break;
        }
       return route()->back()->with('Success','Fillter applied successfully.');
    }

    protected function getReport(string $repname)
    {
        $report = new FeesReport;
        if ($repname === 'fees') {
            $report = new FeesReport;
        } elseif ($repname == 'registrants') {
            $report = new RegistrantsReport;
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
