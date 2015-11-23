<?php require_once('Connections/connect.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
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

$colname_rsExamList = "-1";
if (isset($_GET['examId'])) {
  $colname_rsExamList = $_GET['examId'];
}
mysql_select_db($database_connect, $connect);
$query_rsExamList = sprintf("SELECT * FROM createexams WHERE id = %s", GetSQLValueString($colname_rsExamList, "int"));
$rsExamList = mysql_query($query_rsExamList, $connect) or die(mysql_error());
$row_rsExamList = mysql_fetch_assoc($rsExamList);
$totalRows_rsExamList = mysql_num_rows($rsExamList);

$colname_rsQuestions = "-1";
if (isset($_GET['examId'])) {
  $colname_rsQuestions = $_GET['examId'];
}
mysql_select_db($database_connect, $connect);
$query_rsQuestions = sprintf("SELECT * FROM questions WHERE exam_id = %s", GetSQLValueString($colname_rsQuestions, "text"));
$rsQuestions = mysql_query($query_rsQuestions, $connect) or die(mysql_error());
$row_rsQuestions = mysql_fetch_assoc($rsQuestions);
$totalRows_rsQuestions = mysql_num_rows($rsQuestions);
?>
<strong<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Questions From Exam</title>
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
<div align="right">
  <h5> <a href="ExamList.php">Exam List</a> | <a href="<?php echo $logoutAction ?>">Logout</a></h5>
  
  </div>
<form action="Connections/connect.php" name="temp_exam" method="post" class="form-actions">
<a href="ExamList.php" class="btn btn-primary">Back to List</a>
<table width="120" height="207" border="0" align="center" cellpadding = "10,0,0,0" bgcolor="#FFFFFF" class="table table-striped tab-content table-condensed">
  
  <tr>
    <td height="79" colspan="7" align="center" valign="middle" class="navbar nav-tabs">
	<h3 class="alert-info">List of Questions for <?php echo $row_rsExamList['examName']; ?> (<?php echo $row_rsExamList['exam_year']; ?>) ,<?php echo $row_rsExamList['subject']; ?></h3></td>
  </tr>
  <tr>
           
    <td align="left" class="navbar nav-tabs" height="38"><strong>Question  </strong>
    <td class="navbar nav-tabs" ><strong>Option A</strong>
    <td align="left" class="navbar nav-tabs" ><strong>Option B</strong>
    <td class="navbar nav-tabs" ><strong>Option C</strong>
    <td class="navbar nav-tabs" ><strong>Option D</strong>
    <td class="navbar nav-tabs" ><strong>Answer      </strong></tr>
  <?php do { ?>
  <tr>
      <td align="left" class="navbar nav-tabs"><?php echo $row_rsQuestions['Qid']; ?>.
      <?php echo $row_rsQuestions['question']; ?>
      <td align="left" class="navbar nav-tabs" height="38"><?php echo $row_rsQuestions['option_A']; ?>
      <td class="navbar nav-tabs" ><?php echo $row_rsQuestions['option_B']; ?>
      <td align="left" class="navbar nav-tabs" ><?php echo $row_rsQuestions['option_C']; ?>
      <td class="navbar nav-tabs" ><?php echo $row_rsQuestions['option_D']; ?>
      <td class="navbar nav-tabs" ><?php echo $row_rsQuestions['answer']; ?>
     </tr>
  <?php } while ($row_rsQuestions = mysql_fetch_assoc($rsQuestions)); ?>
<tr>
  <td height="37" colspan="7" align="right" class="navbar nav-tabs nav-stacked" >&nbsp;</td>
</tr>
</table>
<p>&nbsp;</p>
</form>
</div>
</body>

</html>
<?php
mysql_free_result($rsExamList);

mysql_free_result($rsQuestions);
?>
