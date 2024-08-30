<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Reports\FeesReport;
use App\Reports\RegisterRequestReport;
use App\Reports\RegistrantsReport;
use ArPHP\I18N\Arabic;
use Barryvdh\DomPDF\Facade\Pdf;

class SysReportsController extends Controller
{
    protected $reportlist = ['fees', 'registrants', 'orders', 'paiedorders', 'testview'];

    public function index()
    {

        return view('admin.reports', ['reportlist' => $this->reportlist]);
    }

    public function printReport(string $repname)
    {
        $report = new FeesReport;
        $report = $this->getReport($repname);
        $report->run();

        return view('report', ['report' => $report]);
    }

    public function exportReport(string $repname)
    {
        //export report to pdf
        $report = $this->getReport($repname);
        if ($repname == 'testview') {
            $pdf = Pdf::loadView('registrants')
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
        $arabic = new Arabic;

        $report = $this->getReport($repname);
        $report->run();
        // $reportHtml = Pdf::loadView($report->render())
        // ->setPaper('a4', 'portrait');
        $title = ('أسماء المتقدمين');
        //    $reportHtml=view('report', ['report' => $report,'title'=>$text])->render();
        $reportHtml = view('registrants', ['title' => $title])->render();
        //Arabic encode
        $p = $arabic->arIdentify($reportHtml);

        for ($i = count($p) - 1; $i >= 0; $i -= 2) {
            $utf8ar = $arabic->utf8Glyphs(substr($reportHtml, $p[$i - 1], $p[$i] - $p[$i - 1]));
            $reportHtml = substr_replace($reportHtml, $utf8ar, $p[$i - 1], $p[$i] - $p[$i - 1]);
        }
        Pdf::setOption(['dpi' => 150, 'defaultFont' => 'tahoma']);
        $pdf = PDF::loadHTML($reportHtml)->setPaper('a4', 'portrait');

        // $pdf = Pdf::loadView('report', ['report' => $report])
        //     ->setPaper('a4', 'portrait');

        return $pdf->download($repname.'.pdf');
    }

    public function filterReport(Request $request)
    {
        //filter report based on date range
        $startdate = $request->get('startdate');
        $enddate = $request->get('enddate');
        $repname = $request->get('repname');

        $report = $this->getRerport($repname);
        $report->params['startdate'] = $startdate;
        $report->params['enddate'] = $enddate;
        $report->run();

        return view('report', ['report' => $report]);
    }

    protected function getReport(string $repname)
    {
        $report = new FeesReport;
        if ($repname === 'fees') {
            $report = new FeesReport;
        } elseif ($repname == 'registrants') {
            $report = new RegistrantsReport;
        } elseif ($repname == 'orders') {
            $report = new RegisterRequestReport;
        } elseif ($repname == 'testview') {
            $report = view('registrants')->render();
        }

        return $report;
    }
}
