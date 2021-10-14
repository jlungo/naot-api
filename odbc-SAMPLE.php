<?php

//connect to a DSN "myDSN"
$conn = odbc_connect('DSN', 'USER', 'PASSWORD');
$balance = 0;
if ($conn) {
    @$regno = $_GET['regno'];
    @$install = $_GET['install'];
    @$fee = $_GET['fees'];
    @$user = $_GET['user'];
    
    @$sqlquery = "SELECT DCBalance FROM [CBE].[dbo].[Client]
                WHERE [CBE].[dbo].[Client].Account='$regno'";
    $result = odbc_exec($conn, $sqlquery);
    
    while (odbc_fetch_row($result)) {
        @$balance = odbc_result($result, 'DCBalance');
    }
    
    
    //saris server url
    $sarisurl = 'http://saris.cbe.ac.tz';
    if ($install == 1) {
        if (is_null($balance) || $balance <= ($fee/2)) {
            /********************************************************************************************
             * REDIRECT THE STUDENT TO STUDENT MODULE UPON LOGIN BALANCE IS NOT SET *
             *********************************************************************************************/
            echo '<meta http-equiv="refresh" content="0; url=' . $sarisurl . '/student/studentindex.php">';
            exit;
        } else {
            /**************************************************************************
             * REDIRECT THE STUDENT TO LOGIN PAGE IF HE/SHE HASN'T MET ANY REQUIREMENT*
             **************************************************************************/
            echo '<meta http-equiv="refresh" content="0; url=' . $sarisurl . '/index.php?def=1">';
            exit;
        }
    } 
    
    elseif ($install == 2) {
        if ($balance <= 0) {
            /********************************************************************************
             *          DISPLAY SEMESTER I AND SEMESTER 2 RESULTS                           *
             ********************************************************************************/
            //code 3 means pay all installations
            $code = md5(3);
            if ($user == 'officer') {
                $htmlhead = '<meta http-equiv="refresh" content="0; url=' . $sarisurl . '/academic/admissionExamResult.php?inst=' . $code . '&regno='.$regno.'">';
            } else {
                $htmlhead = '<meta http-equiv="refresh" content="0; url=' . $sarisurl . '/student/studentexamresult.php?inst=' . $code . '">';
            }
            echo $htmlhead;
            exit;
        } 
        else {
            if ($balance <= ($fee/3)) {
                /*******************************************************************************
                 * DISPLAY ONLY SEMSETER I RESULTS                                              *
                 ********************************************************************************/
                //code 2 means pay first and second installations
                $code = md5(2);
                if ($user == 'officer') {
                     $htmlhead = '<meta http-equiv="refresh" content="0; url=' . $sarisurl . '/academic/admissionExamResult.php?inst=' . $code . '&regno='.$regno.'">';
                } else {
                     $htmlhead = '<meta http-equiv="refresh" content="0; url=' . $sarisurl . '/student/studentexamresult.php?inst=' . $code . '">';
                }
                echo $htmlhead;
                exit;
            } 
            else {
                /********************************************************************************
                 * DO NOT SHOW BOTH SEMESTER I AND SEMESTER II RESULTS                          *
                 ********************************************************************************/
                //code 1 means pay only first installation
                $code = md5(1);
                if ($user == 'officer') {
                     $htmlhead = '<meta http-equiv="refresh" content="0; url=' . $sarisurl . '/academic/admissionExamResult.php?inst=' . $code . '&regno='.$regno.'">';
                } else {
                    $htmlhead = '<meta http-equiv="refresh" content="0; url=' . $sarisurl . '/student/studentexamresult.php?inst=' . $code . '&balance=' . $balance . '">';
                }
                echo $htmlhead;
                exit;
            }
        }
    }

    odbc_close($conn);
}
else
    echo "odbc not connected";
?>


===========

<?php 
/*
echo "worked";
die();*/
if($examofficer<>1){
//echo "worked";
	require_once('../Connections/sessioncontrol.php');
	require_once('../Connections/zalongwa.php');
	
	
	/********************************************************************
	 * check if the fees payment ratio is not set to redirect to pastel *
	 ********************************************************************/
	if($_SESSION['userCampusID']=='1'){
		if(!isset($_GET['inst'])){
			//get student details
			$get_student = mysql_query("SELECT Programmeofstudy, entryyear FROM student WHERE RegNo='$RegNo'");
			list($prog, $ayear) = mysql_fetch_array($get_student);
			
			//get current accademic year
			$acyear = mysql_query("SELECT AYear FROM academicyear WHERE Status=1 ORDER BY AYear DESC LIMIT 1");
			list($currentyear) = mysql_fetch_array($acyear);
			
			//get student payment information
			$study = ( (integer)substr($currentyear,-4) - (integer)substr($ayear,-4) ) + 1;
			$get_bill = mysql_query("SELECT amount FROM feesrates WHERE ayear='$currentyear' AND yearofstudy='$study' 
									AND programmecode='$prog'");
			list($amount) = mysql_fetch_array($get_bill);
			
			/*		
			echo '<meta http-equiv = "refresh" content ="0; 
					url = http://10.11.11.11/cbe/odbc.php?regno='.$RegNo.'&query1='.$payquery.'&install=2&fees='.$amount.'">';
						

	exit; */
	$editFormAction = $_SERVER['PHP_SELF'];
include '../academic/pastel/includes/config.inc.php';
include '../academic/pastel/pastel.class.php';
$inst = 0;

			}
		}
	
	/************************************
	 * CAPTURE THE RETURNED RATIO VALUE *
	 ************************************/
	 @$ratio = $_GET['inst'];
	 
	# include the header
	include('studentMenu.php');

	global $szSection, $szSubSection, $szTitle, $additionalStyleSheet;

	$szSection = 'Academic Records';
	$szTitle = 'Examination Results';
	$szSubSection = 'Exam Result';

	include("studentheader.php");
	}

	$editFormAction = $_SERVER['PHP_SELF'];



	#check if has blocked
	$qstatus = "SELECT Status,Programmeofstudy FROM student  WHERE (RegNo = '$RegNo')";
	$dbstatus = mysql_query($qstatus);
	$row_status = mysql_fetch_array($dbstatus);
	$status = $row_status['Status'];
	$prog = $row_status['Programmeofstudy'];
$deg=$prog;
	if ($status=='Blocked'){
		echo "Your Examination Results are Currently Blocked<br>";
		echo "Please Contact the Registrar Office to Resolve this Issue<br>";
		exit;
		}


	if (isset($_SERVER['QUERY_STRING'])) {
	  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	  }

	$key = $RegNo;

	include '../academic/includes/showexamresults.php';

if($examofficer<>1){
	include('../footer/footer.php');
	}

?>
