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
//session_start();
function generateGuid($include_braces = false) {
    if (function_exists('com_create_guid')) {
        if ($include_braces === true) {
            return com_create_guid();
        } else {
            return substr(com_create_guid(), 1, 36);
        }
    } else {
        mt_srand((double) microtime() * 10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));
       
        $guid = substr($charid,  0, 8) . '' .
                substr($charid,  8, 4) . '' .
                substr($charid, 12, 4) . '' .
                substr($charid, 16, 4) . '' .
                substr($charid, 20, 12);
 
        if ($include_braces) {
            $guid = '{' . $guid . '}';
        }
   
        return $guid;
    }
}
$_SESSION['examTracker'] = generateGuid(false);
$_SESSION['examId'] = $_GET['examId'];
//echo $_SESSION['examTracker'];
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

$colname_rsInstructions = "-1";
if (isset($_GET['examId'])) {
  $colname_rsInstructions = $_GET['examId'];
}
mysql_select_db($database_connect, $connect);
$query_rsInstructions = sprintf("SELECT * FROM createexams WHERE id = %s", GetSQLValueString($colname_rsInstructions, "int"));
$rsInstructions = mysql_query($query_rsInstructions, $connect) or die(mysql_error());
$row_rsInstructions = mysql_fetch_assoc($rsInstructions);
$totalRows_rsInstructions = mysql_num_rows($rsInstructions);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Computer Based Test</title>
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


<table width="73%" height="420" border="0" align="center" cellpadding = "10,0,0,0" bgcolor="#FFFFCC">
  
  <tr>
    <td class="navbar nav-tabs" height="79" align="center" valign="middle"><h3 class="alert-info">INSTRUCTIONS </h3></td>
    
    
  </tr>
  <tr>
    <td class="navbar nav-tabs" height="256" ><p><?php echo $row_rsInstructions['instructions']; ?><br />
      </tr>
  <tr>
    <td class="navbar nav-tabs nav-stacked" height="60" align="right" >
    <a href="iframeQuestion.php?exam=<?php echo $row_rsInstructions['id']; ?>" class="btn btn-large btn-success">Start Exam 
        </a>

  </tr>
</table>
</form>
</div>



</body>

</html>
<?php
mysql_free_result($rsInstructions);
?>
