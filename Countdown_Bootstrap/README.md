Countdown_Bootstrap
===================

An Creative Countdown-Event-List！——front_end use "Bootstrap"，backstage use "PHP"，DB use "MySQL"

### How to Use ?

#####Runtime Environment:

+ __PHPnow-1.5.6 version and above__.

Make sure that your environment is OK and then put this project "Countdown_Bootstrap" into 
the subdirectory called "htdocs" of PHPnow-1.5.6

#### Please pay attention that the needed DataBase called "list.sql" , I put it into the subdirectory "DataBase" of "Countdown_Bootstrap"  

    .htdocs
    |-- Countdown_Bootstrap
    |   |-- countdown
    |   |-- css
    |   |-- DataBase
    |       |--list.sql
    |   |-- img
    |   |-- js
    |   |-- login.html
    |   |-- conn.php
    |...
    
#### Next, you have to change the password for accessing your own MySQL DB. From above, we can see the file called "conn.php"

```php
<?php 
    ///////////////////////////
    //主要是连接数据库 access MySQL
	/////////////////////////////
	//本地访问数据库  access local DB
	$dbhost = 'localhost'; 
	//你的mysql用户名 
	$dbuser = 'root'; 	
	//你的mysql密码 The Password( You need to change,Use yours )
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
```
    

