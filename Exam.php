<?php require_once('Connections/connect.php'); ?>
<?php 
session_start();
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_connect, $connect);
$query_rsTotalExam = "SELECT * FROM questions WHERE exam_id = '$_GET[exam]'";
$rsTotalExam = mysql_query($query_rsTotalExam, $connect) or die(mysql_error());
$row_rsTotalExam = mysql_fetch_assoc($rsTotalExam);
$totalRows_rsTotalExam = mysql_num_rows($rsTotalExam);

$colname_rsRegistration = "-1";
if (isset($_GET['studentId'])) {
  $colname_rsRegistration = $_GET['studentId'];
}
mysql_select_db($database_connect, $connect);
$query_rsRegistration = sprintf("SELECT * FROM studentreg WHERE id = %s", GetSQLValueString($colname_rsRegistration, "int"));
$rsRegistration = mysql_query($query_rsRegistration, $connect) or die(mysql_error());
$row_rsRegistration = mysql_fetch_assoc($rsRegistration);
$totalRows_rsRegistration = mysql_num_rows($rsRegistration);

$colname_rsCreateExam = "-1";
if (isset($_GET['examId'])) {
  $colname_rsCreateExam = $_GET['examId'];
}
mysql_select_db($database_connect, $connect);
$query_rsCreateExam = sprintf("SELECT duration FROM createexams WHERE examId = %s", GetSQLValueString($colname_rsCreateExam, "int"));
$rsCreateExam = mysql_query($query_rsCreateExam, $connect) or die(mysql_error());
$row_rsCreateExam = mysql_fetch_assoc($rsCreateExam);
$totalRows_rsCreateExam = mysql_num_rows($rsCreateExam);

$nextpage = 0;
if(!isset($_POST['Qid'])) {
$examq = "SELECT * FROM questions WHERE Qid = '1' AND exam_id = '$_GET[exam]'";
}
else {
// Operation 1 - Move to Next Question
$nextpage = $_POST['Qid'] + 1;
$examid = $_POST['exam_id'];
$examq = "SELECT * FROM questions WHERE Qid = '$nextpage' AND exam_id = '$_GET[exam]'";
}

mysql_select_db($database_connect, $connect);
$query_Recordset1 = $examq;
$Recordset1 = mysql_query($query_Recordset1, $connect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<?php
if(isset($_POST['Qid'])) {	
	
	// Operation 2 - Post Answer to Table
	$instable = sprintf("INSERT INTO temp_exam (student_id, Qid, Aid, exam_id, examTracker) VALUES ('%s', '%s', '%s', '%s','%s')", $_POST['student_id'], $_POST['Qid'], $_POST['Aid'], $_POST['exam_id'], $_SESSION['examTracker']);
	
	$runq = mysql_query($instable, $connect) or die(mysql_error());
/*echo $_POST['Aid'];
echo "<br />";
echo $_POST['Qid'];*/
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EXAM QUESTIONS</title>
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<style>
body {
	margin:0 auto;
	width:80%;
}
</style>
</head>

<body>
<p>&nbsp;</p>

<form action="" method="post" name="frmExam" class="tab-content" id="frmExam">
    
    
  <td class="navbar nav-tabs" height="114" align="left" valign="middle">
   
              <?php if($nextpage > $totalRows_rsTotalExam) {  ?>
              <center>
                <span class="text-success">
                <h2>Exam Completed Click to View Result</h2>
                </span>
              </center>
              <br />
        <h2 class="navbar nav-tabs" >
                <center>
                  <a target="_blank" href="result.php?exam=<?php echo $_GET['exam']; ?>" class="btn btn-large btn-success">View Result</a>
                </center>
    <p>
                  <?php } else { ?>
                  <?php $duration = $row_rsCreateExam['duration']; 
			echo $duration
			?>
        </p>
    <table width="100%" height="433" border="0" bgcolor="#FFFFCC">
          <tr>
            <td class="navbar nav-tabs" height="114" align="left" valign="middle"><h4><?php echo $row_Recordset1['Qid']; ?>.<?php echo $row_Recordset1['question']; ?><br />
			    <?php if($row_Recordset1['images'] != "NULL" || $row_Recordset1['images']=="") { ?>
			    <center><img width="80%" src="images/exam/<?php echo $row_Recordset1['images']; ?>" /></center> 
				  <?php } ?>
            </h4></td>
          </tr>
          <tr>
            <td class="navbar nav-tabs" height="210" ><p class="radio">
                <label>
                  <input type="radio" name="Aid" value="<?php echo $row_Recordset1['option_A']; ?>" id="Aid" />
                  <strong>A</strong> <strong><?php echo $row_Recordset1['option_A']; ?></strong></label>
                <br />
                <label>
                  <input type="radio" name="Aid" value="<?php echo $row_Recordset1['option_B']; ?>" id="Aid" />
                  <strong>B</strong> <strong><?php echo $row_Recordset1['option_B']; ?></strong></label>
                <br />
                <label>
                  <input type="radio" name="Aid" value="<?php echo $row_Recordset1['option_C']; ?>" id="Aid" />
                  <strong>C</strong> <strong><?php echo $row_Recordset1['option_C']; ?></strong></label>
                <br />
                <label>
                  <input type="radio" name="Aid" value="<?php echo $row_Recordset1['option_D']; ?>" id="Aid" />
                  <strong>D <?php echo $row_Recordset1['option_D']; ?></strong></label>
                <br />
            </p></td>
          </tr>
          <tr>
            <td class="navbar nav-tabs nav-stacked" height="60" align="right" ><input name="exam_id" type="hidden" id="exam_id" value="<?php echo $_GET['exam']; ?>" />
              <input name="student_id" type="hidden" id="student_id" value="<?php echo $_SESSION['studentId']; ?>" />
              <input name="Qid" type="hidden" id="Qid" value="<?php echo $row_Recordset1['Qid']; ?>" />
              <center>
                <input class="btn btn-large btn-primary" type="submit" name="submit" id="submit" value="NEXT" />
              </center></td>
          </tr>
        </table>
        <?php } ?>
      </tr>
     
    </tr>
    </table>
  </form>
</body>

</html>
<?php
mysql_free_result($rsTotalExam);

mysql_free_result($rsRegistration);

mysql_free_result($rsCreateExam);

//mysql_free_result($rsExamDetails);

mysql_free_result($Recordset1);
?>
