<?php
     require ('./lib/mysql1.php');
     require ('./lib/func1.php');

     if(empty($_POST)){
        
         require(Root.'/view/admin/catadd.html');
    }else{


      $conn = myconn();
      $cat['catname'] = $_POST['catname'];
      $cat['catname'] = form($cat['catname']);
      $sql = "select * from cat where catname='".$cat['catname']."'";
      


      $result = myquery($sql);

      if(mysqli_num_rows($result)>0){

          require ("./lib/func1.php");
          $url = Root.".catadd1.php";

          success('栏目名已经存在',$url);

      }else{
          $url = Root."/catadd1.php";
          if(add('cat',$cat)){

              success('栏目名插入成功',$_SERVER["HTTP_REFERER"]);

          }else{
              echo mysqli_connect_error($conn);
          }

      }




    }
