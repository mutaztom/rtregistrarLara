<?php

namespace App\Reports;

require_once base_path().'/vendor/koolreport/core/autoload.php';

class RegistrantsMonthly extends \koolreport\KoolReport
{
    use \koolreport\bootstrap4\Theme;
    use \koolreport\clients\Bootstrap;
    use \koolreport\laravel\Friendship;

    public function setup()
    {
        // $orderid = $this->params['orderid'];
        $this->src('mysql')
            ->query(
                'select count(id) as registrants, monthname(ondate) as month,year(ondate) as year
                from tblregistrant
                 where year(ondate)=:year
                group by monthname(ondate),year(ondate)',
                [
                    ':year' => $this->params['year'],
                ]
            )->pipe($this->dataStore('regmonthly'));

        $this->src('mysql')
            ->query(
                'select count(id) as registrants, monthname(ondate) as month,year(ondate) as year
                from tblregistrant
                 where year(ondate)=:year
                group by monthname(ondate),year(ondate)',
                [
                    ':year' => $this->params['year'],
                ]

            )->pipe($this->dataStore('regmonthlychart'));
    }
}
