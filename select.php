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
			<select name="typeid">
			<?php
				//1. 导入配置信息
				require("dbconfig.php");

				//2. 获取数据库连接
				$link = @mysql_connect(HOST,USER,PASS) or die("数据库连接失败！");
				mysql_select_db(DBNAME,$link);
				mysql_query("set names utf8");
				
				//3. 实现数据的查询
				$sql = "select * from type order by concat(path,id)";
				$result = mysql_query($sql,$link);
				
				//4. 遍历解析输出内容
				while($row = mysql_fetch_assoc($result)){
					$m=substr_count($row['path'],",")-1;			//计算子串在字符串中出现的次数
					$strpad = str_pad("",$m*6*2,"&nbsp;");			//把字符串填充为指定的长度
					if($row['pid']==0){
						$dbd = "disabled";
					}else{
						$dbd="";
					}
					echo "<option {$dbd} value='{$row['id']}'>{$strpad}{$row['name']}</option>";
				}
				//5. 释放结果集，关闭数据库连接
				mysql_free_result($result);
				mysql_close($link);
			?>
			</select>
		</center>
	</body>
</html>