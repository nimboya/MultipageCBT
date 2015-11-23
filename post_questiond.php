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
<?php require_once('Connections/connect.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "input_question")) {
   
  // Upload File
  if(isset($_FILES['userfile']['tmp_name']) && $_FILES['userfile']['tmp_name'] != '') {
    $fname = mt_rand().".jpg";
    move_uploaded_file($_FILES['userfile']['tmp_name'],"images/exam/".$fname);
  } else {
	$fname = "NULL";
  }
  
  
  $insertSQL = sprintf("INSERT INTO questions (Qid, question, option_A, option_B, option_C, option_D, answer, exam_id, images) VALUES (%s, %s, %s, %s, %s, %s, %s, %s,%s)",
                       GetSQLValueString($_POST['qid'], "int"),
                       GetSQLValueString($_POST['question'], "text"),
                       GetSQLValueString($_POST['optionA'], "text"),
                       GetSQLValueString($_POST['optionB'], "text"),
                       GetSQLValueString($_POST['optionC'], "text"),
                       GetSQLValueString($_POST['optionD'], "text"),
                       GetSQLValueString($_POST['answer'], "text"),
                       GetSQLValueString($_POST['examId'], "text"),
					   GetSQLValueString($fname, "text"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($insertSQL, $connect) or die(mysql_error());

  $insertGoTo = "post_questiond.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_rsExam = "-1";
if (isset($_GET['examId'])) {
  $colname_rsExam = $_GET['examId'];
}
mysql_select_db($database_connect, $connect);
$query_rsExam = sprintf("SELECT * FROM createexams WHERE id = %s", GetSQLValueString($colname_rsExam, "int"));
$rsExam = mysql_query($query_rsExam, $connect) or die(mysql_error());
$row_rsExam = mysql_fetch_assoc($rsExam);
$totalRows_rsExam = mysql_num_rows($rsExam);

mysql_select_db($database_connect, $connect);
$query_rsEid = "SELECT * FROM createexams";
$rsEid = mysql_query($query_rsEid, $connect) or die(mysql_error());
$row_rsEid = mysql_fetch_assoc($rsEid);
$totalRows_rsEid = mysql_num_rows($rsEid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INPUT QUESTIONS</title>
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/bootstrap.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
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

	<h3 align="center" class="alert-success"> Enter the question, the following Options and the correct answer in the space provided below </h3>	  

<form class="navbar-form" name="input_question" enctype="multipart/form-data" action="<?php echo $editFormAction; ?>" method="POST">
  <h4><center>
    <?php echo $row_rsExam['examName']; ?> <?php echo $row_rsExam['exam_year']; ?> , <?php echo $row_rsExam['subject']; ?>
  </center>
  </h4>
  <table bgcolor="#FFFF00" width="62%" height="379" border="0" align="center" class="tab-content">
    <tr>
    <td align="right"><strong>Question No.:</strong></td>
    <td ><span id="sprytextfield2">
    <label for="qid"></label>
    <input name="qid" type="text" class="input-large" id="qid" />
    <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Enter integer value only.</span></span></td>
  </tr>
   <tr>
    <td align="right"><strong>Question:</strong></td>
    <td><textarea name="question" cols="100" id="question"></textarea>
    </td>
  </tr>
   <!-- <tr>
      <form action="./upload.php" method="post" enctype="multipart/form-data">-->
   <tr>
  
   <td align="right"><label for="file">
     <strong>
     <label for="file"><strong>Upload:</strong></label>
     </strong></td>
   <td> <input type="file" name="userfile" id="userfile"> <br /></td>
  </tr>
  
  <tr>
    <td align="right"><strong>Option A:</strong></td>
    <td><input name="optionA" type="text" class="input-large" id="optionA" value="" size="100" /></td>
  </tr>
  <tr>
    <td align="right"><strong>Option B:</strong></td>
    <td><input name="optionB" type="text" class="input-large" id="optionB" value="" size="100" /></td>
  </tr>
  <tr>
    <td align="right"><strong>Option C:</strong></td>
    <td><input name="optionC" type="text" class="input-large" id="optionC" value="" size="100" /></td>
  </tr>
  <tr>
    <td align="right"><strong>Option D:</strong></td>
    <td><input name="optionD" type="text" class="input-large" id="optionD" value="" size="100" /></td>
  </tr>
  <tr>
    <td align="right"><strong>Correct Answer:</strong></td>
    <td><input name="answer" type="text" class="input-large" id="answer" value="" size="100" /></td>
  </tr>
  
  <tr>
    <td><input name="examId" type="hidden" id="examId" value="<?php echo $row_rsExam['id']; ?>" /></td>
    <td>
      <input class="btn btn-large btn-success" type="submit" name="submit" id="submit" value="Post Question" />
    </td>
  </tr>
  <input type="hidden" name="MM_insert" value="input_question" />
<input type="hidden" name="MM_insert" value="input_question" />
</form>

</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer");
</script>
</body>
</html>
<?php
mysql_free_result($rsExam);

mysql_free_result($rsEid);
?>
