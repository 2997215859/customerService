<?php 
if(empty($_COOKIE['username'])){
	setcookie('username','user'.rand(10000,99999));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>customer</title>
	<style type="text/css">
	#msgzone{
		width: 500px;
		height: 300px;
		border: 1px solid gray;
		overflow :auto;
	}
	</style>
	<script type="text/javascript" src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(function(){
			var setting ={
				url:"cometByAjax.php",
				success:function(data,status){
					console.log(data.content);
					$("<p>客服对你说<br/>"+data.content+"</p>").appendTo($('#msgzone'));
					$.ajax(setting);//递归
				},
				dataType:'json'//返回值类型
			};
			$.ajax(setting);
		});
		function ask() {
			var cont = $('textarea:first').val();

			$.post('sendMsg.php',
			{
				rec:'admin',
				content:cont
			},
			function(data,status){
				// alert(data);
				if(data == "send success"){
					var newP = $("<p>你对客服说<br/>"+cont+"</p>");//在留言界面上添加问题内容
					$('#msgzone').append(newP);
					cont = $('textarea:first').val('');
				}else{

				}
			});
		}
		
	</script>
</head>
<body>
	<h1>comet反向ajax技术--在线客服系统--之用户端</h1>
	<h3>原理：ajax+长轮询，获取实时内容，并更新到父页面</h3>
	<div id="msgzone"></div>
	回复：<span id="rec"></span>
	<p><textarea id="queryContent"></textarea></p>
	<input type="button" value="询问" onclick="ask()"></input>
</body>
</html>