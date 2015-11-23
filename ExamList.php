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

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM createexams WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($deleteSQL, $connect) or die(mysql_error());
}

mysql_select_db($database_connect, $connect);
$query_rsExamList = "SELECT * FROM createexams";
$rsExamList = mysql_query($query_rsExamList, $connect) or die(mysql_error());
$row_rsExamList = mysql_fetch_assoc($rsExamList);
$totalRows_rsExamList = mysql_num_rows($rsExamList);


if(isset($_GET['action']) && $_GET['action'] == "del")
{
	$runqa = mysql_query("DELETE FROM questions WHERE exam_id='$_GET[recid]'");
	$runqb = mysql_query("DELETE FROM createexams WHERE id='$_GET[recid]'");
	header("Location: ExamList.php");
	//echo "Jesus is Lord";
}
$_SESSION['studentId'] =  $_SESSION['MM_Username'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exam Lists</title>
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

<table width="96%" height="202" border="0" align="center" cellpadding = "10,0,0,0" bgcolor="#FFFFFF" class="table table-striped tab-content table-condensed">

<div align="right">
<?php if(isset($_SESSION['MM_Username']) && ($_SESSION['MM_Username']=="admin")) { ?>
<a href="create_exam.php">Click Here to Create New Exam </a> |  <?php } ?><a href="<?php echo " " . $logoutAction ?>">Log Out</a></div>
  
  <tr>
   <?php if(isset($_SESSION['MM_Username']) && ($_SESSION['MM_Username']=="admin")) { ?>
  <a class="btn btn-primary" href="create_exam.php">Create Exam</a>
  <?php } ?>
    <td height="79" colspan="8" align="center" valign="middle" class="navbar nav-tabs"><h3 class="alert-info">List of Exams     
    </h3></td>
  </tr>
  <tr>
    <td align="left" class="navbar nav-tabs" height="38"><strong>Exam Name</strong></td>
    <td align="left" class="navbar nav-tabs"><strong>Year</strong></td>
    <td class="navbar nav-tabs" ><strong>Subject  </strong></td>
    <td align="left" class="navbar nav-tabs" ><strong>Duration  </strong></td>
    <td colspan="4" class="navbar nav-tabs" ><strong><center>Actions</center></strong></td></tr>
    <?php if($totalRows_rsExamList > 0) {?>
	<?php do { ?>
	<tr>
      <td height="38" align="left" class="navbar nav-tabs"><?php echo $row_rsExamList['examName']; ?></td>
      <td height="38" align="left" class="navbar nav-tabs"><?php echo $row_rsExamList['exam_year']; ?></td>      
      <td class="navbar nav-tabs" ><?php echo $row_rsExamList['subject']; ?></td>
      <td align="left" class="navbar nav-tabs" ><?php echo $row_rsExamList['duration']; ?></td>
      <?php if(isset($_SESSION['MM_Username']) && ($_SESSION['MM_Username']=="admin")) { ?></td>
      <td class="navbar nav-tabs" ><a href="post_questiond.php?examId=<?php echo $row_rsExamList['id']; ?>" class="btn btn-small btn-primary">Add Questions</a></td>
      <td class="navbar nav-tabs" ><a href="Questions.php?examId=<?php echo $row_rsExamList['id']; ?>" class="btn btn-small btn-warning">View Questions 
        </a></td>
      <td class="navbar nav-tabs" ><a href="?action=del&recid=<?php echo $row_rsExamList['id']; ?>" class="btn btn-small btn-danger">Delete Exam</a></td>    
      
      <?php } ?>
      <td class="navbar nav-tabs" ><a href="instructions.php?examId=<?php echo $row_rsExamList['id']; ?>"?examId=<?php echo $row_rsExamList['id']; ?>" class="btn btn-small btn-success">Start Exam 
        </a>
    </tr>
    <?php } while ($row_rsExamList = mysql_fetch_assoc($rsExamList)); ?>
	<?php } ?>
  <tr><?php echo $row_rsExamList['id']; ?>
    <td height="37" colspan="8" align="right" class="navbar nav-tabs nav-stacked" >&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</form>
</div>
</body>

</html>
<?php
mysql_free_result($rsExamList);
?>
