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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "CreateExam")) {
  $insertSQL = sprintf("INSERT INTO createexams (examId, examName, exam_year, subject, duration, instructions) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['examId'], "int"),
                       GetSQLValueString($_POST['examName'], "text"),
					   GetSQLValueString($_POST['year'], "text"),
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['duration'], "int"),
                       GetSQLValueString($_POST['instructions'], "text"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($insertSQL, $connect) or die(mysql_error());

  $insertGoTo = "ExamList.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CREATE EXAM</title>
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
<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">
                 <img src="images/logo.jpg" alt="logo" width="1078" height="89" /></div>
  </section>
<div align="right">
  <h5> <a href="ExamList.php">Exam List</a> | <a href="<?php echo $logoutAction ?>">Logout</a></h5>
  </div>
  
<form action="<?php echo $editFormAction; ?>" name="CreateExam" method="POST" class="form-actions">
<table width="73%" height="420" border="0" align="center" cellpadding = "10,0,0,0" bgcolor="#FFFFCC">
  <tr>
    <td class="navbar nav-tabs" height="79" align="center" valign="middle">
	<a href="ExamList.php" class="btn btn-warning">Back</a>
	<h3 class="alert-info">CREATE EXAM </h3>
	</td>
  </tr>
  <tr>
    <td class="navbar nav-tabs" height="256" align="center" >
    <table width="600" border="0">
  <tr>
    <td width="103">Exam Name:</td>
    <td width="487"><input class="input-large" name="examName" type="text" /></td>
  </tr>
  <tr>
    <td>Exam Year:</td>
    <td><input class="input-large" name="year" type="text" /></td>
  </tr>
  <tr>
    <td>Subject:</td>
    <td><input class="input-large" name="subject" type="text" /></td>
  </tr>
  <tr>
    <td>Duration:</td>
    <td><input class="input-large" name="duration" type="text" />(in minutes, please figure only)</td>
  </tr>
  <tr>
    <td>Instructions:</td>
    <td> <textarea class=" iinput-large"  name="instructions" cols="" rows=""></textarea> </td>
  </tr>
</table>

     </tr>
  <tr>
    <td class="navbar nav-tabs nav-stacked" height="60" align="right" ><input name="examId" type="hidden" id="examId" value="<?php echo(mt_rand()); ?>" />      <input class="btn btn-large btn-primary" type="submit" name="submit" id="submit" value="Create Exam" /></td>
  </tr>
</table>
<input type="hidden" name="MM_insert" value="CreateExam" />
</form>
</div>
</body>

</html>