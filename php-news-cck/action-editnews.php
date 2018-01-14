<?php
// 处理编辑操作的页面 
require "dbconfig.php";
// 连接mysql
$link = @mysql_connect(HOST,USER,PASS) or die("提示：数据库连接失败！");
// 选择数据库
mysql_select_db(DBNAME,$link);
// 编码设置
mysql_set_charset('utf8',$link);

// 获取修改的新闻
$id = $_POST['id'];
$title = $_POST['title'];
$keywords = $_POST['keywords'];
$autor = $_POST['autor'];
$addtime = $_POST['addtime'];
$content = $_POST['content'];
// 更新数据
mysql_query("UPDATE news SET title='$title',keywords='$keywords',autor='$autor',addtime='$addtime',content='$content' WHERE id=$id",$link) or die('修改数据出错：'.mysql_error()); 
header("Location:demo.php");  

