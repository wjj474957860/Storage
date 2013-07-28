<?php
	//引入session准备使用
	session_start();
	//注销登录
	if($_GET['action'] == "logout"){
	    unset($_SESSION['userid']);
	    unset($_SESSION['username']);
	    header("Location: logout.html");
	    exit;
	}
?>