<?php
// 实现无限分类的信息添加和删除等操作

//1. 导入配置信息
require("dbconfig.php");

//2. 获取数据库连接
$link = @mysql_connect(HOST,USER,PASS) or die("数据库连接失败！");
mysql_select_db(DBNAME,$link);
mysql_query("set names utf8");

//3. 根据action参数的值，做对应操作
switch($_GET["action"]){
	case "add":
		//获取要添加的信息
		$name=$_POST["name"];
		$pid =$_POST["pid"];
		$path=$_POST['path'];
		//执行添加操作
		$sql = "insert into type values(null,'{$name}',{$pid},'{$path}')";
		mysql_query($sql,$link);
		//判断是否成功！
		if(mysql_insert_id($link)>0){
			echo "添加成功！";
		}else{
			echo "添加失败！";
		}
		echo "<br/><a href='add.php'>继续添加</a>";
		break;
	case "del":
		//获取要删除的id号，拼装sql语句
		$id = $_GET["id"];
		$sql = "delete from type where id={$id} or path like '%,{$id},%'";
		
		//执行删除
		mysql_query($sql,$link);
		//输出删除的行数
		echo "成功删除".mysql_affected_rows($link)."行";
		break;
}	

//4. 关闭连接
mysql_close($link);