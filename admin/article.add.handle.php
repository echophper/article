<?php
	require_once("../connect.php");
	//echo $_POST["title"];
	if(empty($_POST["title"])){
		echo "<script>alert('标题不能为空！'); location.href='article.add.php';</script>";
		//没有跟exit的话后面的代码会继续执行，用开发者工具的调试器可以查看到后面的插入已经成功：
		/*
		*<script>alert('标题不能为空！'); location.href='article.add.php';</script><br />
		*<b>Notice</b>:  Undefined index: title in <b>C:\wamp\www\dy1\admin\article.add.handle.php</b> on line <b>13</b><br />
		*<br />
		*<b>Notice</b>:  Undefined index: author in <b>C:\wamp\www\dy1\admin\article.add.handle.php</b> on line <b>14</b><br />
		*<br />
		*<b>Notice</b>:  Undefined index: description in <b>C:\wamp\www\dy1\admin\article.add.handle.php</b> on line <b>15</b><br />
		*<br />
		*<b>Notice</b>:  Undefined index: content in <b>C:\wamp\www\dy1\admin\article.add.handle.php</b> on line <b>16</b><br />
		*<script>alert('插入成功！'); location.href='article.add.php';</script>
		*
		*/
		exit; //记得要加上exit要不后面符合逻辑的代码还是会继续执行。
		//header("location: article.add.php");//header location后面的代码依旧还执行，所以要紧跟exit
		//exit;//用header跳转一样即使判断到空还是会插入
	}
	
	//对用户输入的数据永远都不能相信要进行过滤，待优化
	$title = $_POST["title"];
	$author = $_POST["author"];
	$description = $_POST["description"];
	$content = $_POST["content"];
	$dateline =time();
	
	//预处理
	$sql_insert = "insert into article(title, author, description, content, dateline) values (?,?,?,?,?)";
		
	$inser_con = $con->prepare($sql_insert);
	
	$inser_con->bindParam(1, $title);
	$inser_con->bindParam(2, $author);
	$inser_con->bindParam(3, $description);
	$inser_con->bindParam(4, $content);
	$inser_con->bindParam(5, $dateline);
	
	
	try{
		$inser_con->execute();
		echo "<script>alert('插入成功！'); location.href='article.add.php';</script>";
	
	}catch(PDOException $e){
		echo "insert faile:".$e->getMessage();
	}
	
	
