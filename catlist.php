<meta charset="utf8">
<?php 
/****
布尔教育 高端PHP培训
培  训: http://www.itbool.com
论  坛: http://www.zixue.it
****/
//连接数据库
$conn = mysql_connect('localhost' , 'root' , '');
mysql_query('use 1224blog' , $conn);
mysql_query('set names utf8');

$sql = "select * from cat";
$rs = mysql_query($sql);
$cat = array();
while($row = mysql_fetch_assoc($rs)) {
	$cat[] = $row;
}
//print_r($cat);

require('./view/admin/catlist.html');

?>