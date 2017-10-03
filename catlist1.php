<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/21
 * Time: 19:05
 */

    require ('./lib/mysql1.php');


        $sql = "select * from cat ORDER by cat_id";
        $cat = alldata($sql);
        require ('./view/admin/catlist1.html');




