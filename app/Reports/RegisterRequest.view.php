<?php
use koolreport\widgets\koolphp\Table;

?>
<html>
<head>    

    <title>Registration Request Order</title>
</head>
<body style="margin-top:2cm;margin-right:2cm;margin-bottom:2cm;margin-left:3cm;width:100%; margin-top :2cm">
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../assets/bs3/bootstrap-theme.min.css" />
   
    <h4>View of request </h4>
<?php
Table::create([
    'dataStore' => $this->dataStore('registrants'),
    'cssClass' => [
        'table' => 'table table-hover table-bordered',
    ],
    'width' =>'80%',
]);
?>
</body>
</html>