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

$colname_rsExamDetail = "-1";
if (isset($_GET['exam'])) {
  $colname_rsExamDetail = $_GET['exam'];
}
mysql_select_db($database_connect, $connect);
$query_rsExamDetail = sprintf("SELECT duration FROM createexams WHERE id = %s", GetSQLValueString($colname_rsExamDetail, "int"));
$rsExamDetail = mysql_query($query_rsExamDetail, $connect) or die(mysql_error());
$row_rsExamDetail = mysql_fetch_assoc($rsExamDetail);
$totalRows_rsExamDetail = mysql_num_rows($rsExamDetail);
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
	width:100%;
}
</style>
</head>

<body>
<p>&nbsp;</p>
<div id="wrapper" class="container">
  <td align="center" >
    <table width="73%" height="409" border="0" align="center" cellpadding = "10,0,0,0" bgcolor="#FFFFCC" class="table">
      <tr>
        <td height="114" align="left" valign="middle">
          <div id="wrapper2" class="container">
            <section class="navbar main-menu">
              <div class="navbar-inner main-menu"> 
              <img src="images/logo.jpg" alt="logo" width="1078" height="89"/></div>
            </section>
             </div>
         
         <div align="right" class="timer">
 <input id="ed" type="hidden" name="ed" value="<?php echo $row_rsExamDetail['duration']; ?>" />   
    <script>
	//var dynmins = $('#ed');
	//alert(dynmins);
	var timcounter = document.getElementById('ed').value;
    var mins = timcounter; //Set the number of minutes you need
    var secs = mins * 60;
    var currentSeconds = 0;
    var currentMinutes = 0;
    setTimeout('Decrement()',1000);

    function Decrement() {
        currentMinutes = Math.floor(secs / 60);
        currentSeconds = secs % 60;
        if(currentSeconds <= 9) currentSeconds = "0" + currentSeconds;
        secs--;
        document.getElementById("timerText").innerHTML = currentMinutes + " Mins : " + currentSeconds + " Sec"; //Set the element id you need the time put into.
        if(secs !== -1) setTimeout('Decrement()',1000);
		
		if(currentMinutes == 0 && currentSeconds == 0)
		{
			alert('Time Elapsed');
			document.getElementById('examFrame').src = "result.php";
			
		}
    }
</script>

 <h2 class="text-info" id="timerText"></h2>
    
    </div>
  
  <div>
  <center><iframe id="examFrame" src="Exam.php?exam=<?php echo $_GET['exam']; ?>" width="900" height="500" frameborder="0" scrolling="no"> </iframe>
  </center>
  </div>
  

<input name="exam_id" type="hidden" id="exam_id" value="<?php echo $_GET['exam']; ?>" />
      <input name="student_id" type="hidden" id="student_id" value="<?php echo $row_rsRegistration['id']; ?>" />
      <input name="Qid" type="hidden" id="Qid" value="<?php echo $row_Recordset1['Qid']; ?>" /> 
    

             

</body>

</html>
<?php
mysql_free_result($rsExamDetail);
?>
