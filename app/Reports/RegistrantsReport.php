<?php

namespace App\Reports;

require_once base_path().'/vendor/koolreport/core/autoload.php';

use \koolreport\processes\Filter;
class RegistrantsReport extends \koolreport\KoolReport
{
    use \koolreport\bootstrap4\Theme;
    use \koolreport\clients\Bootstrap;
    use \koolreport\laravel\Friendship;

    public function setup()
    {
        $this->src('mysql')->query(
            'SELECT id,regname,email,phone,address,ondate FROM tblregistrant limit 25')
            ->pipe(new Filter(
                [
                    array('ondate',"between", $this->params['startdate'], $this->params['enddate']),
                ]
            )
            )->pipe($this->dataStore('registrants_report'));
    }
}
