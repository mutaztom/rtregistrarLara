<?php
use koolreport\widgets\google\BarChart;
use koolreport\widgets\koolphp\Table;

?>
<html>
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="css/reportstyle.css" />
<head>    
    <title>Registration Request Order</title>
</head>
<body style="margin-top:2cm;margin-right:2cm;margin-bottom:2cm;margin-left:3cm;width:100%; margin-top :2cm">
<div class="container">
    <div style="reportHeader">
        <h1>المجلس الهندسي السوداني</h1>
        
    <h1>Monthly Orders</h1>
    <p class="reportHeader">Applied Filter: <?php echo $this->params['filter'] ?></p>
    <p>Print Date: <?php echo date('d/m/Y') ?></p>
</div>
</div>
<?php
BarChart::create(
    ['title' => 'Monthly Orders',
        'dataSource' => $this->datastore('orderchart')->sort(['month' => 'desc', 'year' => 'desc']),
        'columns' => ['month',
            'ordersNo' => ['label' => 'Number of Orders', 'type' => 'number', 'prefix' => ''],

        ],
    ])
?>
<?php
Table::create([
    'dataStore' => $this->dataStore('ordersmonthly'),
    'columns' => ['month' => ['type' => 'string', 'label' => 'Month'],
        'ordersNo' => ['type' => 'number', 'label' => 'Orders'],
        'total_fees' => ['type' => 'number', 'label' => 'Total Fees', 'prefix' => 'SDG '],
    ],
    'cssClass' => [
        'table' => 'table table-hover table-bordered',
        'width' => '80%', 'fontfamily' => 'DejaVu Sans',
    ],
    'grouping' => [
        'year' => [
            'calculate' => [
                '{sumAmount}' => ['sum', 'total_fees'],
            ],
            'bottom' => function ($calculated_results) {
                return 'Total Fees amount for the period given :'.$calculated_results['{sumAmount}'];
            },
        ],
        'status' => [
            'calculate' => [
                '{sumCount}' => ['sum', 'ordersNo'],
            ],
            'bottom' => function ($calculated_results) {
                return 'Status Sum :'.$calculated_results['{sumCount}'];
            },
        ], ]]);
?>
</body>
</html>