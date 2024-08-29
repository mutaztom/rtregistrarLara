<?php
use koolreport\widgets\koolphp\Table;
?>

<html>
<head>
    <title>Fees List</title>
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap-theme.min.css" />
</head>
<body>
    <h4>Fees List</h4>

<?php
Table::create([
    'dataStore' => $this->dataStore('fees'),
    'cssClass' => [
        'table' => 'table table-hover table-bordered',
    ],
    'width' =>'80%',
]);
?>
</html>
