<?php
	if(!isset($_POST['submit'])){
	    exit('数据没有被提交过来!');
	}
	$username = $_POST['username'];
	$password = $_POST['password'];
	//注册信息判断
	/*
	if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
	    exit('错误：用户名不符合规定。<a href="javascript:history.back(-1);">返回</a>');
	}
	if(strlen($password) < 6){
	    exit('错误：密码长度不符合规定。<a href="javascript:history.back(-1);">返回</a>');
	}
	if(!preg_match('/^w+([-+.]w+)*@w+([-.]w+)*.w+([-.]w+)*$/', $email)){
	    exit('错误：电子邮箱格式错误。<a href="javascript:history.back(-1);">返回</a>');
	}
	*/
	//包含数据库连接文件
	include('conn.php');
	//检测用户名是否已经存在
	$check_query = mysql_query("select userid from userinfo where username='$username' limit 1");
	if(mysql_fetch_array($check_query)){
	    header("Location: userExist.html");
	    exit;
	}
	//写入数据
	//$password = MD5($password);
	//$regdate = time();
	$sql = "INSERT INTO userinfo(username,password) VALUES('$username','$password')";
	if(mysql_query($sql,$conn)){
	    header("Location: login.html");
	} else {
	    header("Location: regFail.html");
	    exit;
	}
?>