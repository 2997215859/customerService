<?php 
// header('content-type:text/html;charset=utf-8');
$conn = new mysqli("127.0.0.1","root","bngd1223","chat");
if(mysqli_connect_errno()){
	die('Unable to connect!'.$conn->connect_errno.':'.$conn->connect_error);
}else{
	$conn->set_charset('UTF8');
}

?>
