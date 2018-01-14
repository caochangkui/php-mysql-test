<?php
// 处理增加操作的页面 
require "dbconfig.php";
// 连接mysql
$link = @mysql_connect(HOST,USER,PASS) or die("提示：数据库连接失败！");
// 选择数据库
mysql_select_db(DBNAME,$link);
// 编码设置
mysql_set_charset('utf8',$link);

// 获取增加的新闻
$title = $_POST['title'];
$keywords = $_POST['keywords'];
$autor = $_POST['autor'];
$addtime = $_POST['addtime'];
$content = $_POST['content'];
// 插入数据
mysql_query("INSERT INTO news(title,keywords,autor,addtime,content) VALUES ('$title','$keywords','$autor','$addtime','$content')",$link) or die('添加数据出错：'.mysql_error()); 
header("Location:demo.php");  

