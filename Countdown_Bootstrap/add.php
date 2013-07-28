<?php
	//添加事项
	session_start();
	if(!isset($_POST['submit'])){
	    exit('数据没有被提交过来!');
	}
	$endtime = $_POST['endtime'];
	$note = $_POST['note'];
	$uname = $_SESSION['username'];

	include('conn.php');

	$check_query = mysql_query("INSERT INTO list.cdlist (username, note, endtime) VALUES('$uname', '$note', '$endtime')",$conn);
	if($check_query){
	    //登录成功直接进入用户中心
	 	header("Location: countdown.php"); 
	    exit;
	} else {
		//echo "<script> alert("hey!")</script>";
		//echo "<script language="javascript">alert("godd!");</script>"; 
		header("Location: countdown.php"); 
	    exit;
	}
?>