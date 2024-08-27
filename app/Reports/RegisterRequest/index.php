<?
require_once "OrderPrintReport.php";
$order=new OrderPrintReport();
$order->run()->render();