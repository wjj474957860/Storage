<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- 响应式viewport,获取设备的宽度 -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A special CountDown List">
    <meta name="author" content="Spy Email:474957860@qq.com">

	<title>事项倒计时</title>
	<link rel="Shortcut Icon" href="img/favicon.ico">
	<!-- Bootstrap的基本css文件 -->
	<link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
	<!-- 倒计时样式文件 -->
	<link rel="stylesheet" href="countdown/jquery.countdown.css" />
	<style type="text/css">
      body {
        padding: 30px 15% 30px;
      }
      .bgTimeUp{
      	background: #3A3A3A;
      }
      #add .modal-body ,#fetch .modal-body{
		padding: 20px 40px;
	  }
	  .countdownHolder {
		width: 280px;
	  }
    </style>
    <!-- 想要响应式的功能 -->
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.10.3.custom.min.css">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
	<?php
	//用SECSSION里面的值就要这句，要放在第一行
	session_start();

	include('conn.php');

	$username = $_SESSION['username'];
	$query_result = mysql_query("select * from cdlist where username ='$username'");

	//编号
	$counter = 1;
	$count=0;

	//时间操作
    //$t=time();
    //这句可以设置时区
	date_default_timezone_set("asia/chongqing");
	//$nowTime = date("Y-m-d H:i:s",$t);
	//nowTime转化为秒
	//$nowTimeSec = strtotime($nowTime);

	//$ary = array();
	?>
<!-- 页面的开始 -->
	<!-- 固定位置的导航条 -->
	<div class="navbar">
		<div class="navbar-inner">
			<!-- 左侧导航【首页】【关于我们】-->
			<a class="brand">事项倒计时</a>
			<ul class="nav ">
				<li class="divider-vertical">
					<a href="#"><i class="icon-home"></i>首页</a>
				</li>
				<li class="divider-vertical">
					<!-- 添加【关于我们】 -->
					<a href="#us" role="button" data-toggle="modal" data-toggle="modal"><i class="icon-book"></i>关于</a>
				</li>
			</ul>

			<!--右侧导航【用户名】-->
			<ul class="nav pull-right">
				<li>
					<?php $username = $_SESSION['username']; ?>
					<!-- 用户名 -->
					<a href="#me" role="button" data-toggle="modal" data-toggle="modal" class="navbar-link "><i class="icon-user"></i><strong><?php echo $username;?></strong></a>
				</li>
				<li>
					<!-- action=logout url传值 -->
					 <a href="logout.php?action=logout" class="navbar-link"><i class="icon-off"></i>退出</a>
				</li>
			</ul>
		</div>
	</div>

<!-- 页面主要内容 -->
	<div class="container-fluid">
	<!-- 中间大标语 banner -->
		<hr>
		<div class="hero-unit">
			<blockquote>
				<h1 class="text-center">我们共同开发的“倒计时”!!</h1>
				<br>
				<p class="text-center">
					华南师范大学 计算机学院 软件工程9班 【高级软件实做】
				</p>
			</blockquote>
		</div>

<!-- 倒计时的事项列表 -->
		<table class="table table-bordered table-hover ">
			<caption>
				<hr>
				<h1>每一件事都在倒计时...</h1>
				<hr>
				<br>
			</caption>

	<!-- 表头 -->
			<thead>
				<tr>
					<td >
						<h3 class="text-center">编号</h3>
					</td>
					<td>
						<h3 class="text-center">备注</h3>
					</td>
					<td>
						<h3 class="text-center">剩余时间 [ 天:时:分:秒 ]</h3>
					</td>
					<td>
						<h3 class="text-center">操作</h3>
					</td>
				</tr>
			</thead>

	<!-- 表主题列表部分 -->
			<tbody id="tbody">
				<?php while ($result = mysql_fetch_assoc($query_result)) { 
					//array_push($ary, strtotime($result['endtime']) - $nowTimeSec);
					?>
				<tr>
					<td>
						<h4 class="text-center" id="<?php echo $counter;?>">
							<?php echo $counter; ?>
						</h4>
					</td>
					<td><!-- 输出note-->
						<h4 class="text-center">
							<?php echo $result['note']; ?>
						</h4>
					</td>

					<!-- 输出结束的时间 -->
					<td class="countdown" data-ts="<?php echo strtotime($result['endtime'])*1000;?>" style="text-align:center;line-height:30px;padding-top:15px;padding-bottom:5px;">
					</td>
					<td style="text-align:center">
						<button data-value="<?php echo $result['id'];?>" class="btn btn-primary btn-large">修改</button>
					</td>
					<td style="text-align:center">
						<button data-value="<?php echo $result['id'];?>" class="btn btn-danger btn-large">删除</button>
					</td>
				</tr>
				<?php
					$counter++;
					//echo $ary[$count++];
					//$count;
				}
				?>
			</tbody>
		</table>

<!-- 添加事项按钮与实现 -->
		<hr>
		<div class="row-fluid">
  			<div class="span6"><button class="btn btn-large btn-block btn-primary addEvent">添加自定义事项</button></div>
  			<div class="span6"><button class="btn btn-large btn-block btn-primary fetchEvent">添加网页事项</button></div>
		</div>
		<hr>

<!-- 添加【关于我们】弹出窗口 -->
		<div id="us" class="modal hide fade" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h3 id="myModalLabel">关于作者</h3>
			</div>
			<div class="modal-body">
				<table class="table table-bordered table-hover ">
					<thead>
						<tr>
							<td>
								<h4 class="text-center">称呼</h4>
							</td>
							<td>
								<h4 class="text-center">微博</h4>
							</td>
							<td>
								<h4 class="text-center">联系及反馈邮箱</h4>
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<a href="http://pigerla.com/" alt="Spy" title="进入Spy个人Blog"> <h4 class="text-center">Spy</h4>
								</a>
							</td>
							<td>
								<a href="http://weibo.com/52spy1314" alt="Spy" title="关注Spy微博"> <h4 class="text-center">Im-Spy</h4>
								</a>
							</td>
							<td>
								<h4 class="text-center">474957860@qq.com </h4>
							</td>
							</tr>
					</tbody>
				</table>
							
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">确定</button>
			</div>
		</div><!--End 添加【关于我们】弹出窗口 -->

<!-- 添加【用户】弹出窗口 -->
		<div id="me" class="modal hide fade" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">欢迎您，亲爱的</h3>
			</div>
			<div class="modal-body">
				<h2 class="text-center"><?php echo $username;?></h2>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">确定</button>
			</div>
		</div><!-- End 添加【用户】弹出窗口 -->


<!-- 确认删除弹出窗口 -->
		<div id="deleteEvent" class="modal hide fade" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h2 id="myModalLabel">警告！</h2>
			</div>
			<div class="modal-body">
				<h3 class="text-center">你确定要删除此事项吗？</h3>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
				<button class="btn btn-primary delete" data-dismiss="modal" aria-hidden="true">确定</button>
			</div>
		</div><!-- End 确认删除弹出窗口 -->

<!-- 添加自定义事件弹出窗口 -->
		<div id="add" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<form name="addForm" method="post" action="add.php" 
			      onSubmit="return addEventCheck(this)" class="form-signin">
			<div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">请输入结束时间</h3>
			  </div>
			<div class="modal-body">
			        <label>时间格式为“<strong>年-月-日 时:分:秒</strong>”</label>
			        <label>例如：<strong>2013-07-01 20:00:23</strong></label>
			        <input type="text" id="endtime" name="endtime" class="input-block-level" placeholder="2013-07-01 20:00:23"> 
			        <label>请为该事项添加备注，例如：<strong>去学习</strong></label>
			        <input type="text" id="note" name="note" class="input-block-level" placeholder="去学习">		    
		  	</div>
		  	<div class="modal-footer">
		    	<button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
		    	<button class="btn btn-primary" name="submit" type="submit">确定</button>
		  	</div>
		</form>
		</div><!-- End 添加自定义事件弹出窗口 -->

<!-- 添加自定义事件弹出窗口 -->
		<div id="fetch" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<form name="fetchForm" method="post" action="fetch.php" 
      		onSubmit="return fetcheventForm(this)" class="form-signin">
			<div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">请输入获取时间的网址</h3>
			  </div>
			<div class="modal-body">
			    <label>网址格式，如：<strong>http://pigerla.com/</strong></label>
        		<input type="text" id="website" name="website" class="input-block-level" placeholder="http://pigerla.com/">		    
		  	</div>
		  	<div class="modal-footer">
		    	<button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
		    	<button class="btn btn-primary" name="submit" type="submit">确定</button>
		  	</div>
		</form>
		</div><!-- End 添加自定义事件弹出窗口 -->

<!-- 结束时间不能为空 -->
		<div id="endTime" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		    <h3 id="myModalLabel">提示</h3>
		  </div>
		  <div class="modal-body">
		    <h4>结束时间不能为空！</h4>
		  </div>
		  <div class="modal-footer">
		    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">确定</button>
		  </div>
		</div><!-- End 结束时间不能为空 -->
<!-- 事项备注不能为空！ -->
		<div id="myNote" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		    <h3 id="myModalLabel">提示</h3>
		  </div>
		  <div class="modal-body">
		    <h4>事项备注不能为空！</h4>
		  </div>
		  <div class="modal-footer">
		    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">确定</button>
		  </div>
		</div><!-- End 事项备注不能为空！ -->
<!-- 网页地址不能为空！ -->
		<div id="myWebsite" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		    <h3 id="myModalLabel">提示</h3>
		  </div>
		  <div class="modal-body">
		    <h4>网页地址不能为空！</h4>
		  </div>
		  <div class="modal-footer">
		    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">确定</button>
		  </div>
		</div>
	</div><!--the end of .container-fluid -->

	<script src="js/jquery-2.0.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="countdown/jquery.countdown.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>

<!-- 删除按钮的响应 -->
	<script>
        $(document).ready(function () {
	        $(".btn-danger").click(function () {				
				var that = $(this);
				var id = that.attr("data-value");
				//if (!confirm("确定删除此事项？")) {
					//return;
				//};
				$("#deleteEvent").modal('show');
				$(".delete").click(function () { 
					 $.ajax({
					url: "delete.php",
					data: {
						id: id
					},
					type: 'get',
					success: function (data) {
						console.log(data);
						that.parents("tr").remove();

						}
					});
				});
				});				  
            });
    </script>

<!-- 添加自定义事项、网页事项的响应 -->
	<script>
        $(document).ready(function () {
        	//添加自定义事项的响应
	        $(".addEvent").click(function () {
				$("#add").modal('show');
			});

			//添加网页事项的响应
			$(".fetchEvent").click(function () {
				$("#fetch").modal('show');
			});				  
        });
    </script>

<!-- 输入结束时间和事项备注是否为空 -->
    <script type="text/javascript">
      function addEventCheck(addEventForm){
        if(addEventForm.endtime.value == ""){
          //alert("结束时间不能为空！");
          $('#endTime').modal('show');
          $('#endTime').on('hidden', function () {
  			addEventForm.endtime.focus();
		  });
          
          return false;
        }
        if(addEventForm.note.value == ""){
          //alert("事项备注不能为空！");
          $('#myNote').modal('show');
          $('#myNote').on('hidden', function () {
          	addEventForm.note.focus();
      	  });
          return false;
        }
      }
    </script>

<!-- 检查网页地址是否输入为空 -->
    <script type="text/javascript">
      function fetcheventForm(fetchForm){
        if(fetchForm.website.value == ""){
          //alert("网页地址不能为空！");
          $('#myWebsite').modal('show');
          $('#myWebsite').on('hidden', function () {
          	fetchForm.website.focus();
          });
          return false;
        }
      }
    </script>

    <script type="text/javascript">
    //汉化操作
     jQuery(function($){
        $.datepicker.regional['zh-CN'] = {
        closeText: '关闭',
         prevText: '&#x3c;上月',
         nextText: '下月&#x3e;',
         currentText: '今天',
         monthNames: ['一月','二月','三月','四月','五月','六月',
         '七月','八月','九月','十月','十一月','十二月'],
         monthNamesShort: ['一','二','三','四','五','六',
         '七','八','九','十','十一','十二'],
         dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
         dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
         dayNamesMin: ['日','一','二','三','四','五','六'],
         weekHeader: '周',
         dateFormat: 'yy-mm-dd',
         firstDay: 0,
         isRTL: false,
         showMonthAfterYear: true,
         yearSuffix: '年'};
          $.datepicker.setDefaults($.datepicker.regional['zh-CN']);
      });
      $('#endtime').datetimepicker({
        showSecond: true,
        timeFormat: 'HH:mm:ss'
      });
    </script>
</body>
</html>