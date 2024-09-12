<?php

namespace App\Reports;

require_once base_path().'/vendor/koolreport/core/autoload.php';

use Carbon\Carbon;
use koolreport\processes\Filter;

class RegistrantsReport extends \koolreport\KoolReport
{
    use \koolreport\bootstrap4\Theme;
    use \koolreport\clients\Bootstrap;
    use \koolreport\laravel\Friendship;

    protected string $filter = '';

    public function setup()
    {
        $this->src('mysql')->query(
            'SELECT id,regname,email,phone,address,ondate FROM tblregistrant')
            ->pipe(new Filter(
                [
                    ['ondate', 'between', $this->params['startdate'], $this->params['enddate']],
                ]
            )
            )->pipe($this->dataStore('registrants_report'));
    }
}
