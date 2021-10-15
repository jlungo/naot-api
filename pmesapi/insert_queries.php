<?php
include 'conn.php';
include 'database.php';

//get the values
$code = $_GET[''];
$period = $_GET[''];
$value = $_GET[''];

//destination url
//dashboard datamart server url
if (isset($code) && strlen($code) > 0){
    $insert = $db->query('INSERT INTO datamart (code,period,value) VALUES (?,?,?)', 'code', 'period', 'value');
    if($insert){
        echo '<br> Indicator '.  $code.' '.$period.' '.$value.' Inserted successully <br>';
    }else{
        echo '<br> Failed to insert  indicator '.  $code.' '.$period.' '.$value.' <br>';
    }
}else{
    $datsourceturl = 'http://10.0.0.8/teammateapi/read_queries.php';		
    echo '<meta http-equiv = "refresh" content ="0; url = '.$datsourceturl.'">';

}
//Close the database:
$db->close();