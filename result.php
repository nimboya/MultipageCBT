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
//echo $_SESSION['examTracker'] . "<br />";
//echo $_SESSION['examId']; 
mysql_select_db($database_connect, $connect);
$query_rsResult = "SELECT COUNT( * ) totalanswers FROM questions, temp_exam WHERE questions.Qid = temp_exam.Qid AND temp_exam.Aid = questions.answer AND questions.exam_id = '$_SESSION[examId]' AND examTracker = '$_SESSION[examTracker]'";
$rsResult = mysql_query($query_rsResult, $connect) or die(mysql_error());
$row_rsResult = mysql_fetch_assoc($rsResult);
$totalRows_rsResult = mysql_num_rows($rsResult);

mysql_select_db($database_connect, $connect);
$query_rsStudentResult = "SELECT * FROM temp_exam, createexams";
$rsStudentResult = mysql_query($query_rsStudentResult, $connect) or die(mysql_error());
$row_rsStudentResult = mysql_fetch_assoc($rsStudentResult);
$totalRows_rsStudentResult = mysql_num_rows($rsStudentResult);

mysql_select_db($database_connect, $connect);
$query_rsTotalQuestions = "SELECT * FROM questions WHERE exam_id = '$_GET[exam]'";
$rsTotalQuestions = mysql_query($query_rsTotalQuestions, $connect) or die(mysql_error());
$row_rsTotalQuestions = mysql_fetch_assoc($rsTotalQuestions);
$totalRows_rsTotalQuestions = mysql_num_rows($rsTotalQuestions);

mysql_select_db($database_connect, $connect);
$query_rsRegistration = "SELECT * FROM studentreg";
$rsRegistration = mysql_query($query_rsRegistration, $connect) or die(mysql_error());
$row_rsRegistration = mysql_fetch_assoc($rsRegistration);
$totalRows_rsRegistration = mysql_num_rows($rsRegistration);

$stuid_rsExamDetails = $_SESSION['studentId'];
mysql_select_db($database_connect, $connect);
$query_rsExamDetails = sprintf("SELECT `createexams`.`examName`, `createexams`.`exam_year`, `createexams`.`subject`, `studentreg`.`name`,`studentreg`.`studentId` FROM `temp_exam`,`createexams`,`studentreg` WHERE `temp_exam`.`exam_id` = `createexams`.`id` AND `studentreg`.`email`= %s", GetSQLValueString($stuid_rsExamDetails, "text"));
$rsExamDetails = mysql_query($query_rsExamDetails, $connect) or die(mysql_error());
$row_rsExamDetails = mysql_fetch_assoc($rsExamDetails);
$totalRows_rsExamDetails = mysql_num_rows($rsExamDetails);
?>
<title>Result Panel</title>
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<style type="text/css">
body {
	margin-right: 0px;
	margin-bottom: 20px;

}
</style>
</head>

<body>
<p>&nbsp;</p>

<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">
                <img src="images/logo.jpg" alt="logo" width="1078" height="89" /></div>
  </section>

<form action="Connections/connect.php" name="temp_exam" method="post" class="form-actions">

<table width="150%" height="207" border="0" align="center" cellpadding = "10,0,0,0" bgcolor="#FFFFFF" class="table table-striped tab-content table-condensed">
  


<p>&nbsp;
  	
</p>
<table width="100%">
  <tr>
    <td height="79" colspan="8" align="center" valign="middle" class="navbar nav-tabs"><h3 class="alert-info"><a href="ExamList.php">Back</a><center>RESULT PANEL</center></h3></td>
  </tr>
  <tr style="display:none;">
    <td align="right" valign="middle"><h4><span class="tabs-right"><strong>STUDENT IDs</strong></span></h4></td>
    <td  align="center" valign="middle"><h4><?php echo $row_rsExamDetails['studentId']; ?></h4></td>
    
	
	<?php echo $row_rsStudentResult['student_id'] ?>
  </tr>
  <tr>
    <td align="center" valign="middle"><h4><span class="tabs-right"><strong>STUDENT NAME</strong></span></h4></td>
    <td valign="middle"><h4><?php echo $row_rsExamDetails['name']; ?></h4></td>
  </tr>
  <tr style="display:none;">
    <td align="right" valign="middle"><h4><span class="tabs-right"><strong>EXAMINATION NAME</strong></span></h4></td>
    <td align="center" valign="middle"><h4><?php echo $row_rsExamDetails['examName']; ?></h4></td>
  <tr>
    <td align="center" valign="middle"><h4><span class="tabs-right"><strong>SUBJECT</strong></span></h4></td>
    <td><h4><?php echo $row_rsExamDetails['subject']; ?></h4></td>
  </tr>
  <tr style="display:none;">
    <td align="right" valign="middle"><h4><span class="tabs-right"><strong>SCORE</strong></span></h4></td>
    <td align="center" valign="middle"><h4><span class="tabs-right"><?php echo $row_rsResult['totalanswers']; ?></span></h4></td>
  </tr>
<tr>
    <td height="37" colspan="8" align="center" valign="middle" ><h4>&nbsp;</h4>      <h4><span class="navbar nav-tabs nav-stacked"><center>
      <h2> 
	  <?php
	  if($row_rsResult['totalanswers'] == 0)
	  { 
	  	echo "You Scored 0%";
	  }
	  else {
        $percent = ($row_rsResult['totalanswers'] / $totalRows_rsTotalQuestions) * 100;   
		echo "You Scored " . number_format($percent,0) . " %.";
		//echo $totalRows_rsTotalQuestions;
	   }
	   ?> </h2>
    </center>
    </span></h4></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsResult);

mysql_free_result($rsStudentResult);

mysql_free_result($rsTotalQuestions);

mysql_free_result($rsRegistration);
?>
