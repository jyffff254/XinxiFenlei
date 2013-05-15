<html>
	<head>
		<title>无线分类信息管理</title>
	</head>
	<body>
		<center>
			<?php 
				include("menu.php"); //导入导航栏
			
			?>
			<h3>浏览分类信息</h3>
			<table width="600" border="1">
				<tr>
					<th>id号</th><th>类别名称</th>
					<th>父id</th><th>路径</th>
					<th>操作</th>
				</tr>
				<?php
					//1. 导入配置信息
					require("dbconfig.php");

					//2. 获取数据库连接
					$link = @mysql_connect(HOST,USER,PASS) or die("数据库连接失败！");
					mysql_select_db(DBNAME,$link);
					mysql_query("set names utf8");//将数据库编码设置为UTF-8
					
					//3. 实现数据的查询
					$sql = "select * from type order by concat(path,id)";
					$result = mysql_query($sql,$link);
					
					//4. 遍历解析输出内容
					while($row = mysql_fetch_assoc($result)){
						echo "<tr>";
						echo "<td>{$row['id']}</td>";
						echo "<td>{$row['name']}</td>";
						echo "<td>{$row['pid']}</td>";
						echo "<td>{$row['path']}</td>";
						echo "<td><a href='add.php?pid={$row['id']}&name={$row['name']}&path={$row['path']}{$row['id']},'>添加子类</a>
								<a href='action.php?action=del&id={$row['id']}'>删除</a>
							</td>";
						echo "</tr>";
					}
					//5. 释放结果集，关闭数据库连接
					mysql_free_result($result);
					mysql_close($link);
				?>
			</table>
		</center>
	</body>
</html>