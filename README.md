PHP和Mysql可以对数据库进行简单的增删改查，本文介绍了新闻列表的后台管理。


### Mysql数据库创建

创建一个新闻列表的数据库：

<img src="http://images.cnblogs.com/cnblogs_com/cckui/1147883/o_360%e6%88%aa%e5%9b%be16680913888785.jpg"/> 

## 1. 查询数据库
### 1.1. 创建文件dbconfig.php，保存常量

```
<?php  
define("HOST","localhost");  
define("USER","root");  
define("PASS","********");
define("DBNAME","news");
```
### 1.2. 创建入口文件index.html（连接数据库、查询数据）

```
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>新闻后台管理系统</title>
</head>
<style type="text/css">
.wrapper {width: 1000px;margin: 20px auto;}
h2 {text-align: center;}
.add {margin-bottom: 20px;}
.add a {text-decoration: none;color: #fff;background-color: green;padding: 6px;border-radius: 5px;}
td {text-align: center;}
</style>
<body>
	<div class="wrapper">
		<h2>新闻后台管理系统</h2>
		<div class="add">
			<a href="addnews.html">增加新闻</a>
		</div>
		<table width="960" border="1">
			<tr>
				<th>ID</th>
				<th>标题</th>
				<th>关键字</th>
				<th>作者</th>
				<th>发布时间</th>
				<th>内容</th>
				<th>操作</th>
			</tr>

			<?php
                // 1.导入配置文件
                require "dbconfig.php";
                // 2. 连接mysql
                $link = @mysql_connect(HOST,USER,PASS) or die("提示：数据库连接失败！");
                // 选择数据库
                mysql_select_db(DBNAME,$link);
                // 编码设置
                mysql_set_charset('utf8',$link);

				// 3. 从DBNAME中查询到news数据库，返回数据库结果集,并按照addtime降序排列  
				$sql = 'select * from news order by id asc';
                // 结果集
                $result = mysql_query($sql,$link);
                // var_dump($result);die;

				// 解析结果集,$row为新闻所有数据，$newsNum为新闻数目
				$newsNum=mysql_num_rows($result);  

				for($i=0; $i<$newsNum; $i++){
					$row = mysql_fetch_assoc($result);
					echo "<tr>";
					echo "<td>{$row['id']}</td>";
					echo "<td>{$row['title']}</td>";
					echo "<td>{$row['keywords']}</td>";
					echo "<td>{$row['autor']}</td>";
					echo "<td>{$row['addtime']}</td>";
					echo "<td>{$row['content']}</td>";
					echo "<td>
							<a href='javascript:del({$row['id']})'>删除</a>
							<a href='editnews.php?id={$row['id']}'>修改</a>
						  </td>";
					echo "</tr>";
				}
				// 5. 释放结果集
				mysql_free_result($result);
				mysql_close($link);
			?>
		</table>
	</div>
	
	<script type="text/javascript">
		function del (id) {
			if (confirm("确定删除这条新闻吗？")){
				window.location = "action-del.php?id="+id;
			}
		}
	</script>
</body>
</html>

```

页面如图：
<img src="http://images.cnblogs.com/cnblogs_com/cckui/1147883/o_360%e6%88%aa%e5%9b%be165811275310756.jpg" />

## 2. 增加新闻

### 2.1 点击增加按钮，通过页面addnews.html添加数据

```
<!DOCTYPE html>  
<html>  
<head lang="en">  
    <meta charset="UTF-8">  
    <title>添加新闻</title>  
</head>
<style type="text/css">
	form{
		margin: 20px;
	}
</style>
<body>
<form action="action-addnews.php" method="post">  
    <label>标题：</label><input type="text" name="title">  
    <label>关键字：</label><input type="text" name="keywords">  
    <label>作者：</label><input type="text" name="autor">  
    <label>发布时间：</label><input type="date" name="addtime">  
    <label>内容：</label><input type="text" name="content">  
    <input type="submit" value="提交">  
</form>  
</body>  
</html>
```
### 2.2 创建处理增加新闻的服务端文件action-addnews.php

```
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
```

## 3. 删除新闻
点击删除按钮，通过服务端文件action-del.php进行删除处理
```
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
```


## 4. 修改新闻
### 4.1 点击修改按钮，跳转到文件editnews.php进行修改处理

```
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
```
### 4.2 通过服务端文件action-editnews.php进行修改处理

```
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
```
