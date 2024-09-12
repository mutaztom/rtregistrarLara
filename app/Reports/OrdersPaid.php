<?php

namespace App\Reports;

require_once base_path().'/vendor/koolreport/core/autoload.php';
use koolreport\processes\Filter;

class OrdersPaid extends \koolreport\KoolReport
{
    use \koolreport\bootstrap4\Theme;
    use \koolreport\clients\Bootstrap;
    use \koolreport\laravel\Friendship;
    

    public function setup()
    {
        // $orderid = $this->params['orderid'];
        $this->src('mysql')
            ->query(
                "SELECT vwregisterrequest.id,regname as Registrant_name,vwregisterrequest.OnDate,status,engclass,engdegree,Amount from vwregisterrequest
                  inner join tblfees on vwregisterrequest.regclass=tblfees.regclass and vwregisterrequest.regcat=tblfees.regdegree
                  where status = 'Paid'"
            )->pipe(new Filter(
                [
                    ['ondate', 'between', $this->params['startdate'], $this->params['enddate']],
                ]))->pipe($this->dataStore('orderspaid'));
    }
}
