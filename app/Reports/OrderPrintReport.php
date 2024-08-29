<?php

namespace App\Reports;

require_once base_path().'/vendor/koolreport/core/autoload.php';

class RegistrantsReport extends \koolreport\KoolReport
{
    use \koolreport\bootstrap4\Theme;
    use \koolreport\clients\Bootstrap;
    use \koolreport\laravel\Friendship;

    public function setup()
    {
        $orderid = $this->params['orderid'];
        $this->src('mysql')
            ->query(
                'select id,item,ondate,status,engclass,engdegree  from vwregisterrequest
                    where id='.$orderid
            )->pipe($this->dataStore('order_print_report'));
    }
}
