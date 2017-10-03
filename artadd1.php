<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/23
 * Time: 15:47
 */
require ('./lib/mysql1.php');
require ('./lib/func1.php');
//var_dump($_POST);
    if(empty($_POST)){
        $sql = "select catname,cat_id from cat";
        $cat = alldata($sql);
        require (Root.'/view/admin/artadd.html');
    }else{
        $art['title'] = form($_POST['title']);
        $art['cat_id'] = form($_POST['cat_id']);
        $art['content'] = form($_POST['content']);
        $art['tags'] = form($_POST['tags']);
        $art['pubtime'] = time();

        $sql = "select count(*) from cat where cat_id='$art[cat_id]'";
        if(oneonedata($sql)==0){

            success('栏目不存在',$_SERVER["HTTP_REFERER"]);exit();
        }
        $sql = "select title from art where title='$art[title]'";
        if(oneonedata($sql)){
            success('文章标题已经存在',$_SERVER["HTTP_REFERER"]);exit();
        }
//
       if(  ($_FILES["pic"]["size"]==0)){
           if(add('art',$art)){
               $art['tags'] = form($_POST['tags']);
               if($art['tags']!=''){


                   $sql = "select art_id from art where pubtime= '$art[pubtime]'";
                   $art_id = oneonedata($sql);
                   $tags = explode(',',$art['tags']);
                  // $sql = "insert tag (art_id,tag) values ('1','2'),('3','4')";
                   $sql = "insert into tag (art_id,tag) values ";
                   for ($i = 0 ;$i<count($tags) ; $i++){
                       $sql.="('".$art_id."','".$tags[$i]."'),";
                   }
                   $sql = rtrim($sql,',');
                   if(!myquery($sql)){
                       success('添加失败',$_SERVER["HTTP_REFERER"]);exit();
                   }
               }
               $cat['cat_id'] = $art['cat_id'];
               $sql = "select num from cat where cat_id = '$cat[cat_id]'";
               $cat['num'] = oneonedata($sql)+1;
               updata('cat',$cat,"cat_id='$cat[cat_id]'");
               success('添加成功',$_SERVER["HTTP_REFERER"]);exit();
           }
       } elseif(
           ($_FILES["pic"]["type"] == "image/gif")
        || ($_FILES["pic"]["type"] == "image/jpeg")
        || ($_FILES["pic"]["type"] == "image/jpg")
        || ($_FILES["pic"]["type"] == "image/pjpeg")
        || ($_FILES["pic"]["type"] == "image/x-png")
        || ($_FILES["pic"]["type"] == "image/png")
           &&($_FILES['pic']['error']==0)){
           $ext = strrchr($_FILES['pic']['name'],'.');

           //$ext = ltrim($ext,'.');
           //echo $ext; exit();
                 $path = Root.'/upload/'.date('Y/m/d');
                 if(!is_dir($path)){
                     mkdir($path,0700,true);
                 }
           $path = $path.'/'.time().$ext;
                 if(move_uploaded_file($_FILES['pic']['tmp_name'],$path)){
                     $art['pic'] = $path;
                     if(add('art',$art)){
                         $art['tags'] = form($_POST['tags']);
                         if($art['tags']==''){
                             $cat['cat_id'] = $art['cat_id'];
                             $sql = "select num from cat where cat_id = '$cat[cat_id]'";
                             $cat['num'] = oneonedata($sql)+1;
                             updata('cat',$cat,"cat_id='$cat[cat_id]'");


                             success('添加成功',$_SERVER["HTTP_REFERER"]);exit();
                         }else{
                             $sql = "select art_id from art where pubtime= '$art[pubtime]'";
                             $art_id = oneonedata($sql);
                             $tags = explode(',',$art['tags']);
                             // $sql = "insert tag (art_id,tag) values ('1','2'),('3','4')";
                             $sql = "insert into tag (art_id,tag) values ";
                             for ($i = 0 ;$i<count($tags) ; $i++){
                                 $sql.="('".$art_id."','".$tags[$i]."'),";
                             }
                             $sql = rtrim($sql,',');
                             if(myquery($sql)){
                                 $cat['cat_id'] = $art['cat_id'];
                                 $sql = "select num from cat where cat_id = '$cat[cat_id]'";
                                 $cat['num'] = oneonedata($sql)+1;
                                 updata('cat',$cat,"cat_id='$cat[cat_id]'");
                                 success('添加成功',$_SERVER["HTTP_REFERER"]);exit();
                             }else{
                                 success('tags失败',$_SERVER["HTTP_REFERER"]);exit();
                             }
                         }

                     }else{
                         success('添加失败',$_SERVER["HTTP_REFERER"]);exit();
                     }
                 }else{
                     success('上传失败',$_SERVER["HTTP_REFERER"]);exit();
                 }
        }else{
           var_dump($_FILES);exit();
           success('上传文件格式不对',$_SERVER["HTTP_REFERER"]);exit();
       }


    }