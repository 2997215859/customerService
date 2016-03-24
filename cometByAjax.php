<?php
// echo json_encode(array('content' => 'af'));
// exit;
set_time_limit(0);
require('./conn.php');
$res = $_COOKIE['username'];
$sql = "select * from msg where rec = '$res' and isread=0 limit 1";
while(true){
	$res = $conn->query($sql);
	if($res){
		$arr = $res->fetch_assoc();
		if(!empty($arr)){
			echo json_encode($arr);
			$sql = 'update msg set isread=1 where mid='.$arr['mid'].' limit 1';
			$conn->query($sql);
			exit();
		}else{
			// echo "empty";
		}
	}else{
		echo "send fail".$conn->errno.":".$conn->error;
	}
	sleep(1);
}

?>