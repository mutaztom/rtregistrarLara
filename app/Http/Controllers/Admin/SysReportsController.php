<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Reports\FeesReport;
use App\Reports\RegisterRequestReport;
use App\Reports\RegistrantsReport;
use Barryvdh\DomPDF\Facade\Pdf;

class SysReportsController extends Controller
{
    public function index()
    {
        $reportlist = ['fees', 'registrants', 'orders', 'paiedorders'];

        return view('admin.reports', compact('reportlist'));
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
        $report->run();
        $pdf = Pdf::loadView('report', ['report' => $report])
            ->setPaper('a4', 'portrait');

        return $pdf->stream();
    }

    public function downloadReport(string $repname)
    {
        //export report to pdf
        $report = new FeesReport;
        $report = $this->getReport($repname);
        $report->run();
        $pdf = Pdf::loadView('report', ['report' => $report])
            ->setPaper('a4', 'portrait');

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
        }

        return $report;
    }
}
