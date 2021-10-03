<?php 
error_reporting(0);
session_start();
//$_SESSION['society_id'] = '1';
ob_start();

$con = mysqli_connect("127.0.0.1","root","","society_managment");
if(!$con)
{
	echo "something went wrong";
	die();
}
define('BASE_URL', "http://localhost/4_student_system_managment");
  ?>


