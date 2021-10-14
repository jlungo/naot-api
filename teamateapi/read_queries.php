<?php
include 'conn.php';
include 'database.php';

//destination url
//dashboard datamart server url
$datamarturl = 'http://10.0.0.30';

//Get the Indicator values
# Indicator 1
$code = 'Indicator 1';
$period = date('Y-M');
$accounts = $db->query("SELECT * FROM accounts WHERE PERIOD ='period'");
$value = $accounts->numRows();
//send the retrieved values to the dashboard_datamart
$htmlhead = '<meta http-equiv="refresh" content="0; url=' . $datamarturl . '/datamart/insert_queries.php?code=' . $code .'&period='.$period .'&value='.$value.'">';
echo $htmlhead ;

# Indictor 2
$code = 'Indicator 1';
$period = date('Y-M');
$accounts = $db->query("SELECT * FROM accounts WHERE PERIOD ='period'");
$value = $accounts->numRows();
//send the retrieved values to the dashboard_datamart
$htmlhead = '<meta http-equiv="refresh" content="0; url=' . $datamarturl . '/datamart/insert_queries.php?code=' . $code .'&period='.$period .'&value='.$value.'">';
echo $htmlhead ;


# Indicator 3
$code = 'Indicator 1';
$period = date('Y-M');
$accounts = $db->query("SELECT * FROM accounts WHERE PERIOD ='period'");
$value = $accounts->numRows();
//send the retrieved values to the dashboard_datamart
$htmlhead = '<meta http-equiv="refresh" content="0; url=' . $datamarturl . '/datamart/insert_queries.php?code=' . $code .'&period='.$period .'&value='.$value.'">';
echo $htmlhead ;

# Indicator 4
$code = 'Indicator 1';
$period = date('Y-M');
$accounts = $db->query("SELECT * FROM accounts WHERE PERIOD ='period'");
$value = $accounts->numRows();
//send the retrieved values to the dashboard_datamart
$htmlhead = '<meta http-equiv="refresh" content="0; url=' . $datamarturl . '/datamart/insert_queries.php?code=' . $code .'&period='.$period .'&value='.$value.'">';
echo $htmlhead ;

# Indicator 5
$code = 'Indicator 1';
$period = date('Y-M');
$accounts = $db->query("SELECT * FROM accounts WHERE PERIOD ='period'");
$value = $accounts->numRows();
//send the retrieved values to the dashboard_datamart
$htmlhead = '<meta http-equiv="refresh" content="0; url=' . $datamarturl . '/datamart/insert_queries.php?code=' . $code .'&period='.$period .'&value='.$value.'">';
echo $htmlhead ;

//Close the database:
$db->close();