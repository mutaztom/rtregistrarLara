<?php
namespace App\Reports\ReggisterRequest;
require_once "koolreport/core/autoload.php";


use koolreport\processes\Sort;

class OrderPrintReport extends \koolreport\KoolReport
{
    
    public function settings()
    {
        return [
            'dataSources' => [
                'ectom' => [
                    'connectionString' => 'mysql:host=127.0.0.1;dbname=ectom',
                    'username' => 'root',
                    'password' => 'mezo@rt4sql',
                    'charset' => 'utf8',
                ],
            ],
        ];
    }

    public function setup()
    {
        $this->src('ectom')
            ->query('SELECT * FROM vwregisterrequest where id = ?', [$id])
            ->pipe(new Sort([
                'id' => 'desc',
            ]))
            ->pipe($this->dataStore('orer_print_report'));
    }
}
