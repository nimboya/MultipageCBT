<?php
session_start();
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
$regid = substr(generateGuid(),0, 6);

$_SESSION['examTracker'] = generateGuid(false);
//$_SESSION['examId'] = $_GET['examId'];
//echo $_SESSION['examTracker'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Registration</title>
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




<table width="73%" height="420" border="0" align="center" cellpadding = "10,0,0,0" bgcolor="#FFFFCC">
  
  <tr>
    <td class="navbar nav-tabs" height="79" align="center" valign="middle"><h3 class="alert-info">Student Registration </h3>
  
    </td>
    
    
  </tr>
  <tr>
    <td> 
    <form action="connectReg.php" method="post" name="studentReg">
    
    <table width="514" height="279" border="0" align="center">
  <tr>
    <td width="126">Name:</td>
    <td width="255" ><input class="input-large" type="text" name="name"/></td>
  </tr>
  <tr>
    <td>Email:</td>
     <td><input class="input-large" type="text" name="email"/></td>
  </tr>
  <tr>
    <td>Phone No.:</td>
    <td><input class="input-large" type="text" name="phone"/></td>
  </tr>
  <tr>
    <td>Address:</td>
    <td><input class="input-large" type="text" name="address" /></td>
  </tr>
  <tr>
    <td>Institution:</td>
    <td>
	<select name="institution">
	<option value="male">Male</option>
	<option value="female">Female</option>
	</select>
	</td>
  </tr>
  <tr>
    <td> <input name="studentId" type="hidden" value="<?php echo  $regid; ?>" /></td>
    <td><input name="button" type="submit" class="btn btn-large btn-success" id="button" value="Submit" /></td>
  </tr>
</table>
   
    </form>
  
     <br />
    </tr>
</table>
</div>



</body>

</html>