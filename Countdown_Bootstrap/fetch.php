<?php
	//添加事项
	session_start();
	if(!isset($_POST['submit'])){
	    exit('数据没有被提交过来!');
	}
	$website = $_POST['website'];
	//$note = $_POST['note'];
	$uname = $_SESSION['username'];

	#把simple_html_dom文件引进来，类似jQuery文件
	include('simple_html_dom.php'); 
	//$url2 = "http://www.liketuan.com/product-115733.html";
	$html = file_get_html($website);

	//获取到note了
	$note = $html->find("div .location span ",0)->plaintext;

	$t=time();
    //这句可以设置时区
	date_default_timezone_set("asia/chongqing");
	$nowTime = date("Y-m-d H:i:s",$t);
	//nowTime转化为秒
	$nowTimeSec = strtotime($nowTime);
	//获取到剩下秒数
	$leftTime = $html->find("time.multi_time",0)->timer;
	$endtime  = date("Y-m-d H:i:s", ($nowTimeSec + $leftTime));

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