<?php
/**
 * Created by PhpStorm.
 * User: 潘兴杨
 * Date: 2017/9/28
 * Time: 15:57
 */
    require ('./lib/mysql1.php');
    require (Root.'/lib/func1.php');
    $sql = "select catname,cat_id from cat";
    $cat = alldata($sql);


    $art_id = $_GET['art_id'];
    if(!is_numeric($art_id)){
        header('location:index.php');
    }
$sql = "select art.title,art.art_id,art.content,art.pubtime,user.name,cat.catname,art.comm from ";
$sql .= "(art left join cat on art.cat_id=cat.cat_id) LEFT join user on art.user_id=user.user_id where art.art_id='$art_id'";
$result = myquery($sql);

if(mysqli_num_rows($result)>0){
    $art = onedata($sql);
    //var_dump($art);exit();
    $sql = "select * from comment  where art_id=$art[art_id] ORDER by pubtime DESC";
    $comment = alldata($sql);
    //var_dump($comment);
    require (Root.'/view/front/art.html');
}else{
    header('location:index.php');
}

