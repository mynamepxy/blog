<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/21
 * Time: 19:45
 */
    require ('./lib/mysql1.php');
    require ("./lib/func1.php");
    $cat_id = $_GET['cat_id'];
    $cat_id = form($cat_id);
    $sql = "select * from cat where cat_id='$cat_id'";
    $result = myquery($sql);
    $cat = alldata($sql);
    $num = mysqli_fetch_assoc($result)['num'];

    $rows = mysqli_num_rows($result);

    if($rows==0){
        require ("./lib/func1.php");
        $url = "./catlist1.php";
        success('没有这个栏目名',$url);
    } else{


            $sql = "delete from cat where cat_id='$cat_id'";//echo "<script>alert('wwwww')</script>";exit();
            if(myquery($sql)) {
                $sql = "select * from art where cat_id=$cat_id";
                $result = myquery($sql);
                $art_id = mysqli_fetch_assoc($result)['art_id'];
                $art = alldata($sql);
                $sql = "delete from art where cat_id='$cat_id'";
                if(myquery($sql)){
                    $sql = "delete from tag where art_id=$art_id";
                    if(myquery($sql)){
                        $url = "./catlist1.php";
                        success('栏目名已经删除', $url);
                    }else{

                        add('art',$art);

                        add('cat',$cat);
                    }

                }else{

                    add('cat',$cat);
                    $url = "./catlist1.php";
                    success('删除失败', $url);
                }
            } else{

                success( mysqli_connect_error(myconn()),"./catlist1.php");

            }


    }
