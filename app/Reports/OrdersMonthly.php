<?php

namespace App\Reports;

require_once base_path().'/vendor/koolreport/core/autoload.php';

class OrdersMonthly extends \koolreport\KoolReport
{
    use \koolreport\bootstrap4\Theme;
    use \koolreport\clients\Bootstrap;
    use \koolreport\laravel\Friendship;

    public function setup()
    {
        // $orderid = $this->params['orderid'];
        $this->src('mysql')
            ->query(
                'select count(regname) as ordersNo, monthname(a.ondate) as month,year(a.ondate) as year
                ,sum(amount) as total_fees,status from vwregisterrequest as a
                 inner join tblfees on a.regclass=tblfees.regclass and a.regcat=tblfees.regdegree
                 where year(a.ondate)=:year
                group by monthname(a.ondate),year(a.ondate),status',
                [
                    ':year' => $this->params['year'],
                ]
            )->pipe($this->dataStore('ordersmonthly'));

        $this->src('mysql')
            ->query(
                'select count(regname) as ordersNo, monthname(a.ondate) as month,year(a.ondate) as year
                ,sum(amount) as total_fees from vwregisterrequest as a
                 inner join tblfees on a.regclass=tblfees.regclass and a.regcat=tblfees.regdegree
                 where year(a.ondate)=:year
                group by monthname(a.ondate),year(a.ondate)',
                [
                    ':year' => $this->params['year'],
                ]

            )->pipe($this->dataStore('orderchart'));
    }
}
