<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>修改新闻</title>
</head>
<body>
<?php
    require "dbconfig.php";

    $link = @mysql_connect(HOST,USER,PASS) or die("提示：数据库连接失败！");
    mysql_select_db(DBNAME,$link);
    mysql_set_charset('utf8',$link);
    
    $id = $_GET['id'];
    $sql = mysql_query("SELECT * FROM news WHERE id=$id",$link);
    $sql_arr = mysql_fetch_assoc($sql); 

?>

<form action="action-editnews.php" method="post">
    <label>新闻ID: </label><input type="text" name="id" value="<?php echo $sql_arr['id']?>">
    <label>标题：</label><input type="text" name="title" value="<?php echo $sql_arr['title']?>">
    <label>关键字：</label><input type="text" name="keywords" value="<?php echo $sql_arr['keywords']?>">
    <label>作者：</label><input type="text" name="autor" value="<?php echo $sql_arr['autor']?>">
    <label>发布时间：</label><input type="date" name="addtime" value="<?php echo $sql_arr['addtime']?>">
    <label>内容：</label><input type="text" name="content" value="<?php echo $sql_arr['content']?>">
    <input type="submit" value="提交">
</form>

</body>
</html>
