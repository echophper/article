<?php
	require_once("../connect.php");
	
	//获取要修改的文章的ID，安全期间要对ID进行过滤，待优化
	
	if(is_numeric($_GET["id"])){
		$del_id =  $_GET["id"];
	}else{
		echo "<script>alert('ID不是数字！'); location.href='article.manage.php';</script>";
	}
	
	//删除多条记录：SELECT * FROM `article` where id=92 or id=90 or id=91
	//复选框 待添加功能
	$sql_del = "DELETE FROM article WHERE id = $del_id";
	
	try{
	//执行select查询，返回PDOstatement对象结果集
		$delstatement = $con->query($sql_del);
		//判断返回的影响行数判断是否有删除记录
		if($delstatement->rowCount() > 0){
			echo "<script>alert('成功删除！'); location.href='article.manage.php';</script>";
		}else{
			echo "<script>alert('ID号不存在！'); location.href='article.manage.php';</script>";
		}
	}catch(PDOException $e){
		echo "select sql_del faile:".$e->getMessage();
	}