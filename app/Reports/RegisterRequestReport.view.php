<?php
use koolreport\widgets\koolphp\Table;

?>
<html>
    <style>
        body {
            font-family: 'DejaVu Sans';
        }
        </style>
<head>    
    <title>Registration Request Order</title>
</head>
<body style="margin-top:2cm;margin-right:2cm;margin-bottom:2cm;margin-left:3cm;width:100%; margin-top :2cm">
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap-theme.min.css" />
   <link rel="stylesheet" href="../../../css/reportstyle.css" />
    <div class="reportTitle">View of request </div>
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