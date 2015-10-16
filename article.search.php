<?php

/*简单搜索注意的地方：
*			模糊搜索要用引号括起来
*			搜索的结果分页记得要把搜索的内容也要GET提交
*/
	require_once("connect.php");
	//对用户的输入要进行过滤处理，待优化
	$searchtitle = isset($_GET["searchtitle"]) ? $_GET["searchtitle"] :"";  
	//查询表根据dateline降序排序

	$sql_select = "SELECT * FROM article WHERE title LIKE '%$searchtitle%' ORDER BY DATELINE DESC";
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
		echo "<script>alert('没有符合的内容');window.location.href='article.list.php';</script>";
	}
	
	//上一页
	$prevpage = ($currentpage == 1) ? 1 : ($currentpage - 1);
	
	//下一页
	$nextpage = ($currentpage < $lastpage) ? ($currentpage + 1) : ($nextpage = $lastpage);
	
	//跳转页面的URL
	$url = "article.search.php";

	//每页的起始记录ID
	$pageoffset = ($currentpage-1) * $pagesize; //这要减1,因为第一页的第一天记录从0开始
	
	
	//查询表根据dateline降序排序
	$sql_search = "SELECT * FROM article WHERE title LIKE '%$searchtitle%' ORDER BY DATELINE DESC LIMIT $pageoffset, $pagesize"; //要查询的字符串一定要用引号括起来
	//echo $sql_search; // 输出sql语句在数据库进行执行，确认sql语句正确

	try{
		//执行select查询，返回PDOstatement对象
		$searchstatement = $con->query($sql_search);
		
	}catch(PDOException $e){
		echo "select sql_search faile:".$e->getMessage();
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
				<li><a href="article.list.php">我的文章</a></li>
			</ul>
		</div>
	</div><!--header end-->
	
	
	<!--主体部的布局-->
	<div class="main"> 
		<div class="main_left">

		<?php
			$showline = 0;
			foreach($searchstatement as $result){
				
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
				<span><a href="<?php echo $url."?page=1&"."searchtitle=".$searchtitle;?>">首页</a></span>
				<span><a href="<?php echo $url."?page=".$prevpage."&"."searchtitle=".$searchtitle;?>">上一页</a></span>
				<span><a href="<?php echo $url."?page=".$nextpage."&"."searchtitle=".$searchtitle;?>">下一页</a></span>
				<span><a href="<?php echo $url."?page=".$lastpage."&"."searchtitle=".$searchtitle;?>">尾页</a></span>
				<span>当前页:<?php echo $currentpage;?>页</span>
				<span>&nbsp &nbsp 共<?php echo $lastpage;?>页数</span>
				<span>
					<form method="get" action="<?php echo $url;?>" name="">
						<input type="text" class="pageinput" name="page" value="<?php echo $currentpage;?>" />
						<input type="hidden" name="searchtitle" value="<?php echo $searchtitle;?>"/>
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