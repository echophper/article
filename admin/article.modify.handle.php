<?php
	require_once("../connect.php");

	$id = $_POST['id'];
	$title = $_POST["title"];
	$author = $_POST["author"];
	$description = $_POST["description"];
	$content = $_POST["content"];
	$dateline =time();
	
	//sql语句的变量要用字符串括起来，因为数据库插入字符串一定要用引号括起来的
	$sql_update = "UPDATE article SET title='$title', author='$author', description='$description', content='$content', dateline=$dateline WHERE id = $id";
	//强烈记住要输出来执行看是否正确
	//echo $sql_update;
	$con->exec($sql_update);
	
	try{
	//执行select查询，返回PDOstatement对象结果集
		$updatestatement = $con->exec($sql_update);
		echo "<script>alert('成功修改！'); location.href='article.manage.php';</script>";
	}catch(PDOException $e){
		echo "select sql_update faile:".$e->getMessage();
	}
?>
