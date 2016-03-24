<?php 
/*filename : cometByIframe.php*/
set_time_limit(0);
ob_start();
echo str_repeat(' ',4000),"<br />";
ob_flush();
flush();
require('./conn.php');
$i = 0;
while(true){
	echo str_repeat(' ',4000),"<br />";
	// $i++;
	$sql = 'select * from msg where rec = "admin" and isread=0';
	$res = $conn->query($sql);
	$msg = $res->fetch_assoc();
	if(empty($msg)){
		// echo "Empty";
	}else{
		//insert into msg (rec,pos,content) values('admin','list','nihao');
		$sql = 'update msg set isread=1 where mid='.$msg['mid'].' limit 1';
		$conn->query($sql);
		print_r($msg);
		$msg = json_encode($msg);
		echo '<script type="text/javascript">';
		echo "parent.window.comet(".$msg.")";
		echo "</script>";
		//echo $msg;
		// echo str_repeat(' ',4000),"<br />";
		ob_flush();//强迫php把内容发给apache
		flush();//强迫webserver把内容发送给浏览器
	}

	sleep(1);
}

?>
