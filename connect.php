<?php
	require_once('config.php');

	//连接数据库
	try{
		$con = new PDO(DSN, USERNAME, PASSWORD);
		//echo 'connect success!';
		//$con->exec("use info"); 在DSN已经指定数据库名称
		
	}catch(PDOException $e){
		echo "connet faile:".$e->getMessage();
		exit: //如果不加exit后面的代码会被执行也可以用die
	}
	
	//设置数据库编码
	$con->exec("SET NAMES utf8");

/*
	
	//查询表根据dateline降序排序
	$sql_select = "SELECT * FROM article ORDER BY DATELINE DESC";
	//echo $sql;  输出sql语句在数据库进行执行，确认sql语句正确
	
	try{
		//执行select查询，返回PDOstatement对象
		$constatement = $con->query($sql_select);
		
	}catch(PDOException $e){
		echo "select sql_select faile:".$e->getMessage();
	}
	
	$result = $constatement->fetchAll();
	
	//总记录数
	$totle = count($result);
	
	//每页显示记录数
	$pagesize = 4;  //这个应该写在配置文件中方便维护
	
	//总页数
	//$lastpage = $totle / $pagesize;  //不严谨，要是有余数呢？要是刚好整除呢？
	$lastpage = ceil($totle / $pagesize); //用ceil — 进一法取整
	
	//获取当前页码
	$currentpage = isset($_GET["page"])? $_GET["page"]: 1;
	
	//对获取的页码验证: 是否是数字，大于0， 比总页数小
	if(!is_numeric($currentpage) || $currentpage <= 0 || $currentpage > $lastpage){
		echo "no page!";
		exit;
	}
	
	//上一页
	$prevpage = ($currentpage == 1) ? 1 : ($currentpage - 1);
	
	//下一页
	$nextpage = ($currentpage < $lastpage) ? ($currentpage + 1) : ($nextpage = $lastpage);
	
	//跳转页面的URL
	$url = "article.list.php";

	//每页的起始记录ID
	$pageoffset = ($currentpage-1) * $pagesize; //这要减1,因为第一页的第一天记录从0开始
	
	//每页的查询语句
	$sql_page = "SELECT * FROM article ORDER BY dateline DESC LIMIT $pageoffset, $pagesize";
	
	try{
		//执行select查询，返回PDOstatement对象
		$pagestatement = $con->query($sql_page);
		
	}catch(PDOException $e){
		echo "select sql_page faile:".$e->getMessage();
	}
	

	foreach($pagestatement as $pageinfo){
		print_r($pageinfo["id"]);
		//var_dump($pageinfo);
		echo "<br>";
	}


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<title>个人文章管理发布</title>
	<link  href="default.css" rel="stylesheet" type="text/css"/>
	
</head>
	
<body>
	
	<span><a href="connect.php?page=1">首页</a></span>
	<span><a href="connect.php?page=<?php echo $prevpage;?>">上一页</a></span>
	<span><a href="connect.php?page=<?php echo $nextpage;?>">下一页</a></span>
	<span>
		<form method="get" action="connect.php">
		<input type="text"  name="page" value="" />
		<input type="submit"  value="Go" />
		</form>
	</span>
	<span><a href="connect.php?page=<?php echo $lastpage;?>">尾页</a></span>
	<span>当前页:<?php echo $currentpage;?></span>
	<span>&nbsp &nbsp总<?php echo $lastpage;?>页数</span>
</body>
	
</html>
*/
?>


	
	
	
	
	
