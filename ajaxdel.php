<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/22
 * Time: 16:47
**/
    require ('./lib/mysql1.php');
    $cat_id = $_GET['cat_id'];
    $sql = "select cat_id,num from cat where cat_id=$cat_id";
    $data = onedata($sql);
    $data = json_encode($data);
    echo $data;

