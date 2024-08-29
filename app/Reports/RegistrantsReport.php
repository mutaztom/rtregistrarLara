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
        $this->src('mysql')->query(
            'SELECT id,regname,email,phone,address FROM vwregistrant'
        )->pipe($this->dataStore('registrants_report'));
    }
}
