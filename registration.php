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

$colname_rsRegistration = "-1";
if (isset($_GET['studentId'])) {
  $colname_rsRegistration = $_GET['studentId'];
}
mysql_select_db($database_connect, $connect);
$query_rsRegistration = sprintf("SELECT * FROM studentreg WHERE studentId = %s", GetSQLValueString($colname_rsRegistration, "text"));
$rsRegistration = mysql_query($query_rsRegistration, $connect) or die(mysql_error());
$row_rsRegistration = mysql_fetch_assoc($rsRegistration);
$totalRows_rsRegistration = mysql_num_rows($rsRegistration);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Details</title>
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
<div id="wrapper" class="container">
  <td align="center" class="navbar nav-tabs" ><tr>
    <td class="navbar nav-tabs" height="114" align="left" valign="middle"><h4>&nbsp;</h4>
      <div id="wrapper2" class="container">
        <section class="navbar main-menu">
          <div class="navbar-inner main-menu"> <img src="images/logo.jpg" alt="logo" width="1078" height="89" /></div>
        </section>
      </div>
             
      <h3 class="text-info text-success" align="center">Your Registration was Successful with the Following Details.</h3>
      <p align="center">&nbsp;</p>
       <div class="info" align="right"> <a href="studentLogin.php">Click here for Student Login</a></div>
             
        <h4>            
          <table width="1000" align="center" cellspacing="10" class="text-info table table-striped">
              <tr>
                <td width="240">Student Name</td>
                <td width="324"><?php echo $row_rsRegistration['name']; ?></td>
        </tr>
              <tr>
                <td>Email</td>
                <td><?php echo $row_rsRegistration['email']; ?></td>
              </tr>
              <tr>
                <td>Phone No.</td>
                <td><?php echo $row_rsRegistration['phone']; ?></td>
              </tr>
              <tr>
                <td>Student Registration No.</td>
                <td><?php echo $row_rsRegistration['studentId']; ?></td>
              </tr>
          </table>
      </h4>
      <p>
          
      <p class="text-warning" align="center">&nbsp; </p>
      <h4 class="text-warning" align="center"><strong>Please copy out your student registration number to login for the Exam </strong></h4>
    </body>
</html>
<?php
mysql_free_result($rsRegistration);
?>
