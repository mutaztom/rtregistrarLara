<?php
use koolreport\widgets\koolphp\Table;

?>

<html>
<head>
    <title>Fees List</title>
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="css/reportstyle.css" />
</head>
<body>
    <div class="container">
        <h1>المجلس الهندسي السوداني</h1>
    <h1>Fees List</h1>
    <p>Date: <?php echo date('Y-m-d') ?></p>
<?php
Table::create([
    'dataStore' => $this->dataStore('fees'),
    'cssClass' => [
        'table' => 'table table-hover table-bordered',
    ],
    'width' => '80%',
]);
?>
</div>
</html>
