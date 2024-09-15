<?php
use koolreport\widgets\google\PieChart;
use koolreport\widgets\koolphp\Table;

?>
<html>
    <style>
        .body {
            font-family: 'DejaVu Sans';
        }
        </style>
<head>    
    <title>Registration Request Order</title>
</head>
<body style="margin-top:2cm;margin-right:2cm;margin-bottom:2cm;margin-left:3cm;width:100%; margin-top :2cm">
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap-theme.min.css" />
   <link rel="stylesheet" href="css/reportstyle.css" />

<div class="container">
    <div style="reportHeader">
        <h1>المجلس الهندسي السوداني</h1>
    <h1>Monthly Registrants</h1>
    <p>Applied Filter: <?php echo $this->params['filter'] ?></p>
    <p>Print Date: <?php echo date('d/m/Y') ?></p>
</div>
</div>
<?php
PieChart::create(
    ['title' => 'Monthly Registrants',
        'dataSource' => $this->datastore('regmonthlychart')->sort(['month' => 'desc', 'year' => 'desc']),
        'columns' => ['month',
            'registrants' => ['label' => 'Number of Orders', 'type' => 'number', 'prefix' => ''],

        ],
        'options' => [
            'is3D' => true,
        ],
    ])
?>
<?php
Table::create([
    'dataStore' => $this->dataStore('regmonthly'),
    'columns' => ['month' => ['type' => 'string', 'label' => 'Month'],
        'registrants' => ['type' => 'number', 'label' => 'Number of registrants'],
    ],
    'cssClass' => [
        'table' => 'table table-hover table-bordered',
    ],
    'grouping' => [
        'year' => [
            'calculate' => [
                '{countSum}' => ['sum', 'registrants'],
            ],
            'bottom' => function ($calculated_results) {
                return 'Total Number of registrants :'.$calculated_results['{countSum}'];
            },
        ],
    ]]);
?>
</body>
</html>