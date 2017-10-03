<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/21
 * Time: 16:29
 */
if(isset($_GET)){
    require ('./lib/mysql1.php');
    $conn = myconn();
    $cat['catname'] = $_GET['catname'];
    $cat['catname'] = form($cat['catname']);
    $sql = "select * from cat where catname='".$cat['catname']."'";



    $result = myquery($sql);

    if(mysqli_num_rows($result)>0){
        echo $cat['catname']."这个栏目名已经存在";exit();


    }
}