<?php
/**
 * Created by PhpStorm.
 * User: 潘兴杨
 * Date: 2017/9/26
 * Time: 18:07
 */
    require ('./lib/mysql1.php');
    require (Root.'/lib/func1.php');


        if(!empty($_GET)){
            $art['art_id'] = $_GET['art_id'];
            $art['art_id'] = form($art['art_id']);
            if(!is_numeric($art['art_id'])){
                success('文章ID格式不对','./artlist1.php');exit();
            }
        }


        if(!empty($_POST)){

            $art['title'] = form($_POST['title']);
            $art['cat_id'] = form($_POST['cat_id']);
            $art['content'] = form($_POST['content']);
            $art['tags'] = form($_POST['tags']);
            $art['pubtime'] = time();
            if(updata('art',$art,"art_id='$art[art_id]'")){
                success('修改成功','./artlist1.php');
            }else{
                success('修改失败','./artlist1.php');
            }
        }else{
            $sql = "select * from art where art_id='$art[art_id]'";

            $art = onedata($sql);

            if(!$art){
                success('没有要修改的文章','./artlist1.php');exit();
            }
            $sql = "select cat_id,catname from cat";
            $cat = alldata($sql);
            require (Root.'/view/admin/artedit1.html');
        }

