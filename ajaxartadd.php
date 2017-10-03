<?php
/**
 * Created by PhpStorm.
 * User: 潘兴杨
 * Date: 2017/9/24
 * Time: 21:36
 */
if(isset($_GET)){
    require ('./lib/mysql1.php');
    $conn = myconn();
    $art['title'] = $_GET['title'];
    //echo $art['title'];exit();
    $art['title'] = form($art['title']);
    $sql = "select * from art where title='".$art['title']."'";



    $result = myquery($sql);

    if(mysqli_num_rows($result)>0){
        echo $art['title']."这个文章名已经存在";exit();


    }
}