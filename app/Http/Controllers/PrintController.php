<?php

namespace App\Http\Controllers;

use App\Reports\OrderPrintReport;

class PrintController extends Controller
{
    public function printOrder(int $orderid)
    {
        $report = new OrderPrintReport($orderid);
        $report->run();

        return view('report', ['report' => $report]);
    }
}
