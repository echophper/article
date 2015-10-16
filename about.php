
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
				<li><a href="">关于我</a></li>
				<li><a href="article.list.php">我的文章</a></li>
			</ul>
		</div>
	</div><!--header end-->
	
	
	<!--主体部的布局-->
	<div class="main"> 
		<div class="main_left">
			
			<div class="list_show">
				<div class="list_head">
					关于我
				</div><!--list_head end-->
				
				<div class="list_content">
					屌丝				
				</div>
				
			</div><!--list_show end-->
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