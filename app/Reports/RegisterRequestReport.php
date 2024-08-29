<?php

namespace App\Reports;

require_once base_path().'/vendor/koolreport/core/autoload.php';

class OrderPrintReport extends \koolreport\KoolReport
{
    use \koolreport\bootstrap4\Theme;
    use \koolreport\clients\Bootstrap;
    use \koolreport\laravel\Friendship;

    public function setup()
    {
        $orderid = $this->params['orderid'];
        $this->src('mysql')
            ->query(
                'select id,item,ondate,status,engclass,engdegree  from vwregisterrequest'
            )->pipe($this->dataStore('order_print_report'));
    }
}
