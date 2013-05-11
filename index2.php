<?php
	//1. 导入配置信息
	require("dbconfig.php");

	//2. 获取数据库连接
	$link = @mysql_connect(HOST,USER,PASS) or die("数据库连接失败！");
	mysql_select_db(DBNAME,$link);
	mysql_query("set names utf8");
	
	//获取当前父类别id
	$pid= $_GET['pid']+0;
	
	//判断是否是在根类别下
	if($pid>0){
		//根据当前父类别id号获取对应的类别path信息
		$sql="select path from type where id={$pid}";
		$res = mysql_query($sql,$link);
		$path = mysql_result($res,0,0);
		
		//获取当前位置上的所有路径中类别信息列表
		$sql="select id,name from type where id in({$path}{$pid}) order by id";
		$typeres = mysql_query($sql,$link);
	}

?>

<html>
	<head>
		<title>无线分类信息管理</title>
	</head>
	<body>
		<center>
			<?php 
				include("menu.php"); //导入导航栏
			
			?>
			<h3>分层浏览分类信息</h3>
			<div style="width:600px;text-align:left;">
				路径:<a href="index2.php?pid=0">根类别</a> &gt;&gt;
				<?php 
					//判断并遍历输出路径信息
					if($typeres && mysql_num_rows($typeres)>0){
						while($row=mysql_fetch_assoc($typeres)){
							echo "<a href=\"index2.php?pid={$row['id']}\">{$row['name']}</a> &gt;&gt;";
						}
					}
				
				?>
			</div>
			<table width="600" border="1">
				<tr>
					<th>id号</th><th>类别名称</th>
					<th>父id</th><th>路径</th>
					<th>操作</th>
				</tr>
				<?php
				
					
					//3. 实现数据的查询
					
					$sql = "select * from type  where pid={$pid} order by concat(path,id)";
					$result = mysql_query($sql,$link);
					
					//4. 遍历解析输出内容
					while($row = mysql_fetch_assoc($result)){
						echo "<tr>";
						echo "<td>{$row['id']}</td>";
						echo "<td><a href='index2.php?pid={$row['id']}'>{$row['name']}</a></td>";
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