<?php
use koolreport\widgets\koolphp\Table;

?>
<html>
<head>    
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="../../../css/reportstyle.css"/>
    <title>Registrants</title>
</head>

<body style="margin-top:2cm;margin-right:2cm;margin-bottom:2cm;margin-left:3cm;width:100%; margin-top :2cm">
    <div style="margin:auto;"><span class="reportTitle">Registrants</span></div>
    <div style="reportHeader">
        <h2>المجلس الهندسي السوداني</h2>
        <p>تاريخ الطبا��ة: {{ date('Y-m-d') }}</p>
</div>
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