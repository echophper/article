<?php

/*简单搜索注意的地方：
*			模糊搜索要用引号括起来
*			搜索的结果分页记得要把搜索的内容也要GET提交
			empty()只能判断变量，不能判断对象
*/
	require_once("connect.php");
	
	$checkid = isset($_GET["id"]) ? $_GET["id"] :""; //待优化
	
	//
	$url = "article.show.php";

	$sql_check = "SELECT * FROM article WHERE id=$checkid"; 
	//echo $sql_search; // 输出sql语句在数据库进行执行，确认sql语句正确

	try{
		//执行select查询，返回PDOstatement对象
		$checkstatement = $con->query($sql_check);
		
	}catch(PDOException $e){
		echo "select sql_check faile:".$e->getMessage();
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
				foreach($checkstatement as $result){
				
			?>
	
			<div class="list_show">
				<div class="list_head">
				
					<div class="list_title">
						<p><strong><?php echo $result["title"];?></strong></p>
					</div><!--title end-->
					
					<div class="list_author">
						<p>作者：<?php echo $result["author"]?></p>
					</div><!--author end-->
					
				</div><!--list_head end-->
				
				<div class="list_content">
					<?php echo $result["content"]?>					
				</div>
				
			</div><!--list_show end-->
			<div class="list_bottom"><!--间隔两个DIV--></div>
			<?php
			
				}
			?>
			
			<div class="list_page">
				<?php
				
					//上一篇的查询
					$sql_ptitle = "SELECT * FROM article WHERE id < $checkid ORDER BY id DESC LIMIT 0,1";
									
									
					try{
						//执行select查询，返回PDOstatement对象
						$ptitlestatement = $con->query($sql_ptitle);
						
					}catch(PDOException $e){
						echo "select sql_ptitle faile:".$e->getMessage();
					}
					
					if($ptitlestatement->rowCount() > 0){
					
					
					
						foreach($ptitlestatement as $ptitle){
				?>
					<span>
						上一篇:<a href="<?php echo $url."?id=".$ptitle["id"];?>"><?php echo $ptitle["title"].$ptitle["id"];?></a>
					</span>
				<?php		
						}
					}else{	
				?>	
					<span>上一篇:没有了...</span>
				<?php	
				}
					//下一篇的查询
					$sql_ntitle = "SELECT * FROM article WHERE id > $checkid ORDER BY id ASC LIMIT 0,1";
					
					try{
						//执行select查询，返回PDOstatement对象
						$ntitlestatement = $con->query($sql_ntitle);
						
					}catch(PDOException $e){
						echo "select sql_ntitle faile:".$e->getMessage();
					}
				
					if($ntitlestatement->rowCount() > 0){
						foreach($ntitlestatement as $ntitle){
						
				?>
				
				<span>下一篇:<a href="<?php echo $url."?id=".$ntitle["id"];?>"><?php echo $ntitle["title"].$ntitle["id"];?></a></span>
				<?php
						}
					}else{
				?>
				<span>下一篇:没有了...</span>
				<?php
						
					}
				?>
				
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