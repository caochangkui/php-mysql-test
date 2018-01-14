<?php
// 处理删除操作的页面 
require "dbconfig.php";
// 连接mysql
$link = @mysql_connect(HOST,USER,PASS) or die("提示：数据库连接失败！");
// 选择数据库
mysql_select_db(DBNAME,$link);
// 编码设置
mysql_set_charset('utf8',$link);

$id = $_GET['id'];
//删除指定数据  
mysql_query("DELETE FROM news WHERE id={$id}",$link) or die('删除数据出错：'.mysql_error()); 
// 删除完跳转到新闻页
header("Location:demo.php");  


