<?php 
	require('./lib/mysql1.php');
	require (Root.'/lib/func1.php');
	if (!empty($_GET)) {
		# code...
		$art['art_id'] = $_GET['art_id'];
		$art['art_id'] = form($art['art_id']);


		$sql = "select art_id from art where art_id='$art[art_id]'";
		$result = myquery($sql);

		if(mysqli_num_rows($result)>0){

			if(delete('art',$art)){
                $sql = "select art_id from tag where art_id=$art[art_id]";
                $tag['art_id'] = oneonedata($sql);
                if($tag['art_id']){
                    //var_dump($tag['tag_id']);
                    delete('tag',$tag);
                }
			    success('删除成功','./artlist1.php');
            }
		}else{
            success('没有这个文章名字','./artlist1.php');
        }
	}


 ?>