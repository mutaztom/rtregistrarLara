<?php
use koolreport\widgets\koolphp\Table;

?>
<html>
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="css/reportstyle.css" />
    <link rel="stylesheet" href="{{asset('public/css/reportstyle.css') }}">
    <style>
        .body {
            font-family: 'DejaVu Sans';
        }
        </style>
<head>    
    <title>Registration Request Order</title>
</head>
<body style="margin-top:2cm;margin-right:2cm;margin-bottom:2cm;margin-left:3cm;width:100%; margin-top :2cm">

<div class="container">
    <div style="reportHeader">
        <h1>المجلس الهندسي السوداني</h1>
    <h1>Registration Request Orders</h1>
    
    <p>Applied Filter: <?php echo $this->params['filter'] ?></p>
    <p>Print Date: <?php echo date('d/m/Y') ?></p>
</div>
</div>
<?php
Table::create([
    'dataStore' => $this->dataStore('registerrequest'),
    'cssClass' => [
        'table' => 'table table-hover table-bordered',
    ],
]);
?>
</body>
</html>