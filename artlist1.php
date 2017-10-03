<?php
/**
 * Created by PhpStorm.
 * User: 潘兴杨
 * Date: 2017/9/24
 * Time: 22:10
 */
require ('./lib/mysql1.php');
require ('./lib/func1.php');
    if(empty($_POST)){

        $sql = "select * from art ORDER by art_id";
        $art = alldata($sql);
        for ($i=0;$i<count($art);$i++){
            $art[$i]['pubtime'] = date('Y-m-d',$art[$i]['pubtime']) ;
        }

        require ('./view/admin/artlist.html');

    }