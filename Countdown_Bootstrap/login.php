<?php
	//登录
	if(!isset($_POST['submit'])){
	    exit('数据没有被提交过来!');
	}
	$username = $_POST['username'];
	$password = $_POST['password'];

	include('conn.php');
	//检测用户名及密码是否正确
	$check_query = mysql_query("select userid from userinfo where username='$username' and password='$password' limit 1");
	if($result = mysql_fetch_array($check_query)){
		//session开始，可以理解为开始调用session值来存值。
		session_start();
	    //登录成功
	    $_SESSION['username'] = $username;
	    $_SESSION['userid'] = $result['userid'];

	    //登录成功直接进入用户中心
	    header("Location: countdown.php"); 
	    //echo $username,' 欢迎你！进入 <a href="countdown.php">用户中心</a><br />';
	    //echo '点击此处 <a href="login.php?action=logout">注销</a> 登录！<br />';
	    exit;
	} else {
		header("Location: loginFail.html");
	    exit;
	}
?>