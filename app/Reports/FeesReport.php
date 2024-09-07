<?php

namespace App\Reports;

require_once base_path().'/vendor/koolreport/core/autoload.php';

class FeesReport extends \koolreport\KoolReport
{
    use \koolreport\laravel\Friendship;
    use \koolreport\bootstrap4\Theme;
    use \koolreport\clients\Bootstrap;
    
    public function setup()
    {
        $this->src('mysql')->query(
            'select tblfees.id,tblfees.ondate,tblfees.byuser,tblengclass.item
             as classname,tblengdegree.item as degree,Amount from tblfees 
            join tblengclass on tblfees.regclass=tblengclass.id join tblengdegree
             on tblfees.regdegree=tblengdegree.id;'
        )->pipe($this->dataStore('fees'));
    }
}
