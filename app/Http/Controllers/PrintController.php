<?php

namespace App\Http\Controllers;

use App\Reports\OrderPrintReport;

class PrintController extends Controller
{
    public function printOrder(int $orderid)
    {
        $params=['orderid' => $orderid];
        $report = new OrderPrintReport($params);
        $report->run();
        return view('report', ['report' => $report,'orderid' => $orderid]);
    }
   
}
