<html>
	<head>
		<title>无线分类信息管理</title>
	</head>
	<body>
		<center>
		<?php 
				include("menu.php"); //导入导航栏
			
			?>
			<h3>添加分类信息</h3>
			<form action="action.php?action=add" method="post">
				<input type="hidden" name="pid" value="<?php echo isset($_GET['pid'])?$_GET['pid']:0 ?>"/>
				<input type="hidden" name="path" value="<?php echo isset($_GET['path'])?$_GET['path']:"0," ?>"/>
				<table width="340" border="0">
					<tr>
						<td align="right">父类别：</td>
						<td><?php echo isset($_GET['name'])?$_GET['name']:"根类别" ?></td>
					</tr>
					<tr>
						<td align="right">类别名称：</td>
						<td><input type="text" name="name"/></td>
					</tr>
					
					<tr>
						<td align="right">&nbsp;</td>
						<td>
							<input type="submit" value="添加"/>
							<input type="reset" value="重置"/>
						</td>
					</tr>
				</table>
			</form>
		</center>
	</body>
</html>