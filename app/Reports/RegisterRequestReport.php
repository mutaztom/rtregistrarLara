<?php

namespace App\Reports;

require_once base_path().'/vendor/koolreport/core/autoload.php';
use koolreport\processes\Filter;

class RegisterRequestReport extends \koolreport\KoolReport
{
    use \koolreport\bootstrap4\Theme;
    use \koolreport\clients\Bootstrap;
    use \koolreport\laravel\Friendship;

    public function setup()
    {
        // $orderid = $this->params['orderid'];
        $this->src('mysql')
            ->query(
                'SELECT id,regname,ondate,status,engclass,engdegree from vwregisterrequest'
            )->pipe(new Filter(
                [
                    ['ondate', 'between', $this->params['startdate'], $this->params['enddate']],
                ]))->pipe($this->dataStore('registerrequest'));
    }
}
