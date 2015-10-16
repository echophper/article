<?php
	require_once("../connect.php");
		
	//查询表根据dateline降序排序
	$sql_manage = "SELECT * FROM article ORDER BY DATELINE DESC";
	//echo $sql;  输出sql语句在数据库进行执行，确认sql语句正确
	
	try{
		//执行select查询，返回PDOstatement对象
		$constatement = $con->query($sql_manage);
		
	}catch(PDOException $e){
		echo "select sql_manage faile:".$e->getMessage();
	}
	
	$result = $constatement->fetchAll();
	
	//总记录数
	$totle = count($result);
	
	//每页显示记录数
	$pagesize = 18;  //这个应该写在配置文件中方便维护
	
	//总页数
	//$lastpage = $totle / $pagesize;  //不严谨，要是有余数呢？要是刚好整除呢？
	$lastpage = ceil($totle / $pagesize); //用ceil — 进一法取整
	
	//获取当前页码
	$currentpage = isset($_GET["page"])? $_GET["page"]: 1;
	
	//对获取的页码验证: 是否是数字，大于0， 比总页数小
	if(!is_numeric($currentpage) || $currentpage <= 0 || $currentpage > $lastpage){
		echo "<script>alert('页码不正确');window.location.href='article.list.php';</script>";
	}
	
	//上一页
	$prevpage = ($currentpage == 1) ? 1 : ($currentpage - 1);
	
	//下一页
	$nextpage = ($currentpage < $lastpage) ? ($currentpage + 1) : ($nextpage = $lastpage);
	
	//跳转页面的URL
	$url = "article.manage.php";

	//每页的起始记录ID
	$pageoffset = ($currentpage-1) * $pagesize; //这要减1,因为第一页的第一天记录从0开始
	
	//每页的查询语句
	$sql_page = "SELECT * FROM article ORDER BY dateline DESC LIMIT $pageoffset, $pagesize";
	
	try{
		//执行select查询，返回PDOstatement对象结果集
		$pagestatement = $con->query($sql_page);
		
	}catch(PDOException $e){
		echo "select sql_page faile:".$e->getMessage();
	}
	

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<title>个人文章管理发布</title>
	<link  href="admin.css" rel="stylesheet" type="text/css"/>

</head>
	
<body>

	<!--头部的布局-->
	<div class="header">
		<div class="logo">
			<h1>后台管理</h1>
		</div>
	
	</div><!--header end-->
	
	
	<!--主体部的布局-->
	<div class="main" style="height:600px"> 
		<div class="main_left">
			<ul>
				<li><a href="article.add.php">发布文章</a></li>
				<li><a href="article.manage.php">管理文章</a></li>
			
			</ul>
		</div><!--main_left end-->
			
		<div class="main_right">
			
			<table class="manage_form">
			<tr>
				<td colspan="3" align="center" >文章管理列表</td>
			</tr>
			
			<tr>
				<td width="37" >编号</td>
				<td width="572">标题</td>
				<td width="82">操作</td>
		   </tr>
			<?php
				//for($i=0;$i<18;++$i){
				$showline = 18;
				foreach($pagestatement as $result){
			?>
		   <tr>
				<td>&nbsp;<?php echo $result["id"]?></td>
				<td>&nbsp;<?php echo $result["title"];?></td>
				
					
				<td>	
					<a href="article.del.handle.php?id=<?php echo $result["id"];?>">删除</a>
					<a href="article.modify.php?id=<?php echo $result["id"];?>">修改</a> 
				</td>
		   </tr>
		   <?php
				}
			?>
		   </table>
			
			
			<div class="list_page">
				<span><a href="<?php echo $url."?page=1";?>">首页</a></span>
				<span><a href="<?php echo $url."?page=".$prevpage;?>">上一页</a></span>
				<span><a href="<?php echo $url."?page=".$nextpage;?>">下一页</a></span>
				<span><a href="<?php echo $url."?page=".$lastpage;?>">尾页</a></span>
				<span>当前页:<?php echo $currentpage;?>页</span>
				<span>&nbsp &nbsp 共<?php echo $lastpage;?>页数</span>
				<span>
					<form method="get" action="">
						<input type="text" class="pageinput" name="page" value="" />
						<input type="submit"  value="Go" />
					</form>
				</span>
				
			</div><!--list_page end-->
		</div><!--main_right end-->

	</div><!--main end-->
	
	
	<!--尾部的布局-->
	<div class="footer">
		Copyrignt &copy 2015-ljy
	</div><!--footer end-->
	
</body>
	
	
</html>