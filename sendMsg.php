<?php 
require("./conn.php");
$rec = $_POST['rec'];
$content = $_POST['content'];
$pos = $_COOKIE['username'];
//print_r($rec);
$sql = "insert into msg (rec,pos,content) values('$rec','$pos','$content')";
$res = $conn->query($sql);
if($res){
	echo "send success";
}else{
	echo "send fail".$conn->errno.":".$conn->error;
}
?>