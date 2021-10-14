<?php
include 'conn.php';
include 'database.php';

//destination url
//dashboard datamart server url
$datsourceturl = 'http://10.0.0.8';		
echo '<meta http-equiv = "refresh" content ="0; url = '.$datsourceturl.'">';

//get the values
$code = $_GET[''];
$period = $_GET[''];
$value = $_GET[''];

$insert = $db->query('INSERT INTO datamart (code,period,value) VALUES (?,?,?)', 'code', 'period', 'value');
if($insert){
    echo '<br> Indicator '.  $code.' '.$period.' '.$value.' Inserted successully <br>';
}else{
    echo '<br> Failed to insert  indicator '.  $code.' '.$period.' '.$value.' <br>';
}

//Close the database:
$db->close();