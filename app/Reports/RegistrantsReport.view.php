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
<style>
   
@font-face {
    font-family: "DejaVu Sans";
    src: url("/vendors/dompdf/lib/fonts/DejaVuSans.ttf") format('truetype');
    font-weight: normal;
    font-style: normal;
}
* { font-family: DejaVu Sans, sans-serif; }
    body {
        font-family: 'DejaVu Sans';
    }
</style>

<body>

<div class="container">
    <div style="reportHeader">
        <h1>المجلس الهندسي السوداني</h1>
    <h1>ٌRegistrants</h1>
    <p>Applie Filter: <?php echo $this->params['filter'] ?></p>
    <p>Print Date: <?php echo date('Y-m-d') ?></p>
</div>
<?php
Table::create([
    'dataStore' => $this->dataStore('registrants_report'),
    'cssClass' => [
        'table' => 'table table-hover table-bordered',
    ], 'width' => '80%', 'fontfamily' => 'DejaVu Sans',
]);
?>

</body>
</html>