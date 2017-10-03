<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/22
 * Time: 19:01
 */
require ('./lib/mysql1.php');
require ('./lib/func1.php');
    if(!empty($_GET)){


        $cat_id = $_GET['cat_id'];

        $sql = "select cat_id,catname from cat where cat_id=$cat_id";

        $result = myquery($sql);
        $rows = mysqli_num_rows($result);
        $cat  = onedata($sql);
        if($rows==0){
           $url = "./catlist1.php";
           success("没有这个栏目",$url);
           exit();
        }
        if(!empty($_POST)){

            $cat['catname'] = $_POST['catname'];
            $cat['cat_id'] = $cat_id;
            echo $cat['cat_id'];
           // $cat['num'] = 888;
            //$sql = "select cat_id,catname from cat where cat_id=$cat_id";
           // echo $sql;exit();
            //$cat = onedata($sql);
           // var_dump($cat);exit();
            $flag = updata('cat',$cat,"cat_id='$cat[cat_id]'");
            success('修改成功','./catlist1.php');exit();
        }

        require ('./view/admin/catedit.html');

    }



