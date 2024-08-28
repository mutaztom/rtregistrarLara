<?php

namespace App\Reports;

require_once base_path().'/vendor/koolreport/core/autoload.php';

class OrderPrintReport extends \koolreport\KoolReport
{
    use \koolreport\clients\Bootstrap;
    use \koolreport\laravel\Friendship;
    use \koolreport\bootstrap4\Theme;
    
    protected int $orderid;

    public function __construct(int $orderid)
    {
        $this->orderid = $orderid;
    }

    public function settings()
    {
        return [
            'dataSources' => [
                'ectom' => [
                    'class' => '\koolreport\laravel\Eloquent', // This is important
                ],
            ],
        ];
    }

    public function setup()
    {
        $this->src('ectom')
            ->query(
                Vwregisterrequest::where('id', $this->orderid)
            )
            ->pipe($this->dataStore('order_print_report'));
    }
}
