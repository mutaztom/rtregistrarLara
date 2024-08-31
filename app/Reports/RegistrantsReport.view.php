<?php
use koolreport\widgets\koolphp\Table;

?>
<html>
<head>    
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="assets/css/reportstyle.css" />
    <title>Registrants</title>
</head>

<body style="margin-top:2cm;margin-right:2cm;margin-bottom:2cm;margin-left:3cm;width:100%; margin-top :2cm">
    <div class="flex align-items-center"><h4>Registrants</h4></div>
<?php
Table::create([
    'dataStore' => $this->dataStore('registrants_report'),
    'cssClass' => [
        'table' => 'table table-hover table-bordered',
    ], 'width' => '80%',
]);
?>
</body>
</html>