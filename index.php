<?php 
/****
布尔教育 高端PHP培训
培  训: http://www.itbool.com
论  坛: http://www.zixue.it
****/
require ('./lib/mysql1.php');
require ('./lib/func1.php');


    $sql = "select catname,cat_id from cat";
    $cat = alldata($sql);
$sql = "select art.art_id,art.title,art.content,art.pubtime,user.name,cat.catname,art.comm from ";
 $sql.="(art left join cat on art.cat_id=cat.cat_id) LEFT join user on art.user_id=user.user_id order by art.art_id";
 $arts = alldata($sql);

if(isset($_GET['cat_id'])) {

    $cat_id = $_GET['cat_id'];
    $sql = "select art.art_id,art.title,art.content,art.pubtime,user.name,cat.catname,art.comm from ";
    $sql .= "(art left join cat on art.cat_id=cat.cat_id) LEFT join user on art.user_id=user.user_id where art.cat_id='$cat_id'";

    $arts = alldata($sql);
}

require('./view/front/index.html');

?>