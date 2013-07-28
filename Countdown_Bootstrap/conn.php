<?php 
    ///////////////////////////
	//主要是连接数据库
	/////////////////////////////
	//本地访问数据库
	$dbhost = 'localhost'; 
	//你的mysql用户名 
	$dbuser = 'root'; 	
	//你的mysql密码 
	$dbpass = 'wjj'; 	
	//mysql里面数据库名
	$dbname = 'list';  
	$conn= mysql_connect($dbhost,$dbuser,$dbpass);
	if (!$conn){
	    die("连接数据库失败：" . mysql_error());
	}
	$data = mysql_select_db($dbname, $conn);
	//字符转换，读库
	mysql_query("set character set utf8");
	//写库
	mysql_query("set names utf8");
?>