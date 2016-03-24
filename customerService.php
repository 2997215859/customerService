<?php 
setcookie('username','admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>customer</title>
	<script type="text/javascript" src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
	<script type="text/javascript">
		function comet(msg){
			// alert(msg);
			var cont = "";
			cont +='<span onclick="selectReply(this)">'+msg.pos+'</span>'+"对你说<br/>";
			cont +=msg.content+"<br/>";
			// alert(cont);
			document.getElementById("msgzone").innerHTML +=cont;
		}
		function selectReply(obj) {
			// alert(obj.innerHTML);
			// console.log(obj);
			document.getElementById("rec").innerHTML = obj.innerHTML;
		}
		function reply(){
			var reciver = $("#rec").text();
			var content = $("#content").val();
			// alert(reciver);
			// alert(content);
			if(reciver && content){
				$.post("./sendMsg.php",
				{
					rec:reciver,
					content:content
				},
				function(data,status){
					// alert(data);
					var rep = '';
					rep += '你对'+reciver+'说</br>';
					rep += content+'<br/>';
					document.getElementById("msgzone").innerHTML += rep;
					$('#content').val(null);
					
				});
			}else{
				alert("请选择回复人并填入留言内容");
			}
		}
	</script>
	<style type="text/css">
	#msgzone{
		width: 500px;
		height: 300px;
		border: 1px solid gray;
		overflow :auto;
	}

	</style>
</head>

<body>
	<h1>comet反向ajax技术--在线客服系统--客服端</h1>
	<h2>特点:界面粗糙，技术不粗糙</h2>
	<h3>原理:iframe+长链接,获取实时内容,并更新到父页面</h3>
	<div id="msgzone"></div>
	回复:<span id="rec"></span>
	<p><textarea id ="content"></textarea></p>
	<input type="button" value="回复" onclick="reply()"></input>
	<iframe src="cometByIframe.php" width="0px" height="0px" frameborder="0px"></iframe>
</body>
</html>