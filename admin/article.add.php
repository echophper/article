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
	<div class="main"> 
		<div class="main_left">
			<ul>
				<li><a href="article.add.php">发布文章</a></li>
				<li><a href="article.manage.php">管理文章</a></li>
			</ul>
		</div><!--main_left end-->
		
		<div class="main_right">
			<form method="post" action="article.add.handle.php">
			<table width="680" border="0" cellpadding="8" cellspacing="1">
			
			<tr>
				<td colspan="4" align="center"><h3>发布文章</h3></td>
			</tr>
			
			<tr>
			  <td width="119">标题</td>
			  <td width="625"><label for="title"></label>
			<input type="text" name="title" /></td>
			</tr>
			
			<tr>
			  <td>作者</td>
			  <td><input type="text" name="author" /></td>
			</tr>
			
			<tr>
			  <td>简介</td>
			  <td><label for="description"></label>
				<textarea name="description" cols="60" rows="5"></textarea></td>
			</tr>
			
			<tr>
			  <td>内容</td>
			  <td><textarea name="content" cols="60" rows="20" ></textarea></td>
			</tr>
			
			<tr>
			  <td colspan="2" align="right"><input type="submit" name="button"  value="提交" /></td>
		    </tr>
	
			</table>
			</form>
		</div><!--main_left end-->
	
	</div><!--main end-->
	
	
	<!--尾部的布局-->
	<div class="footer">
		Copyrignt &copy 2015-ljy
	</div><!--footer end-->
	
</body>
	
	
</html>