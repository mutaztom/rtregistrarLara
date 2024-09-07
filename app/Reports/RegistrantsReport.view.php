<?php
use koolreport\widgets\koolphp\Table;
use koolreport\widgets\google\ColumnChart;

?>
<html>
<head>    
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="../../../css/reportstyle.css"/>
    <title>Registrants</title>
</head>

<body>
<div class="container">
    <div style="reportHeader">
        <h1>المجلس الهندسي السوداني</h1>
    <h1>ٌRegistrants</h1>
    
    <p>Print Date: <?php echo date('Y-m-d') ?></p>
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