 <?php
 	include('conn.php');
 	//删除事项
    $q = "DELETE FROM `cdlist` WHERE `id` = '".$_GET["id"]."'";
   	mysql_query($q); 
?>