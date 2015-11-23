<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
//mysql_connect("localhost", "root", "");
//mysql_select_db("cbt_exam");
require_once("Connections/connect.php");
$sqlins = mysql_query("INSERT INTO studentreg (`name`, `institution`, `email`, `phone`, `address`, `studentId`) VALUES ('$_POST[name]', '$_POST[institution]', '$_POST[email]', '$_POST[phone]',  '$_POST[address]', '$_POST[studentId]')", $connect);

if ($sqlins == 1)
{
	echo "success";	
	header("Location: registration.php?studentId=" . $_POST['studentId'] );
}
else {
	echo "failure:".mysql_error();
}

?>
</body>
</html>
