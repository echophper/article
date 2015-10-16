<?php
	require_once("connect.php");
	
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
		echo "<script>alert('页码不正确');window.location.href='article.list.php';</script>";
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
	<meta http-equiv="Page-Exit"; content="blendTrans(Duration=0.5)">
	<title>个人文章管理发布</title>
	<link  href="default.css" rel="stylesheet" type="text/css"/>
</head>
	
<body>

	<!--头部的布局-->
	<div class="header">
		<div class="logo">
			<h1>千里之行</h1>
			<h4>——坚持就是胜利</h4>
		</div>
		
		<div class="headmenu">
			<ul>
				<li><a href="contact.php">联系我</a></li>
				<li><a href="about.php">关于我</a></li>
				<li><a href="<?php echo $url;?>">我的文章</a></li>
				<li><a href="admin/article.manage.php">后台</a></li>
			</ul>
		</div>
	</div><!--header end-->
	
	
	<!--主体部的布局-->
	<div class="main"> 
		<div class="main_left">

		<?php
			$showline = 0;
			foreach($pagestatement as $result){
				
				if($showline++ >= 4)//每页显示的记录数量
					break;
				
		?>
			<div class="list">
				<div class="list_head">
				
					<div class="list_title">
						<p><strong><?php echo $result["title"]?></strong></p>
					</div><!--title end-->
					
					<div class="list_author">
						<p>作者：<?php echo $result["author"]?></p>
					</div><!--author end-->
					
				</div><!--list_head end-->
				
				<div class="list_desc">
					<?php echo $result["description"]?>					
				</div>
				
				<div class="list_footer">
					<span><a href="article.show.php?id=<?php echo $result["id"];?>">更多详细</a>&nbsp;&nbsp;&raquo;&nbsp;&nbsp;</span>
				</div>
			</div><!--list end-->
			
			<div class="list_bottom"><!--间隔两个DIV--></div>
		<?php
				
			}
		?>
			<div class="list_page">
				<span><a href="<?php echo $url."?page=1";?>">首页</a></span>
				<span><a href="<?php echo $url."?page=".$prevpage;?>">上一页</a></span>
				<span><a href="<?php echo $url."?page=".$nextpage;?>">下一页</a></span>
				<span><a href="<?php echo $url."?page=".$lastpage;?>">尾页</a></span>
				<span>当前页:<?php echo $currentpage;?>页</span>
				<span>&nbsp &nbsp 共<?php echo $lastpage;?>页数</span>
				<span>
					<form method="get" action="<?php echo $url;?>">
						<input type="text" class="pageinput" name="page" value="<?php echo $currentpage;?>" />
						<input type="submit"  value="Go" />
					</form>
				</span>
				
			</div><!--list_page end-->
			
			
		</div><!--main_left end-->
		
		<div class="main_right">
			<h2>Searchtitle</h2>
			<form method="get" action="article.search.php" >
				<input type="text" class="search_text" name="searchtitle" value=""/>
				<input type="submit" class="search_icon" value="Go" />
			</from>
		</div><!--main_left end-->
	
	</div><!--main end-->
	
	
	<!--尾部的布局-->
	<div class="footer">
		<p>Copyrignt &copy 2015-ljy</p>
	</div><!--footer end-->
	
</body>
	
	
</html>