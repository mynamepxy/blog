<?php
/**
 * Created by PhpStorm.
 * User: 潘兴杨
 * Date: 2017/9/28
 * Time: 20:12
 */
require ('./lib/mysql1.php');
require (Root.'/lib/func1.php');

if(!empty($_POST)){

    //echo 1111;
    //echo json_encode($_POST);
        $comment['art_id'] = $_POST['art_id'];
        $comment['nick'] = form($_POST['nick']);
        $comment['email'] = form($_POST['email']);
        $comment['content'] = form($_POST['content']);
        $comment['pubtime'] = time();


        if(add('comment',$comment)){
             $sql = "select comm from art where art_id=$comment[art_id]";
             $art['comm'] = oneonedata($sql)+1;
             updata('art',$art,"art_id=$comment[art_id]");
             $sql = "select * from comment where art_id='$comment[art_id]'";
             $datas = alldata($sql);
             $datas = json_encode($datas);
             echo $datas;
        }

}