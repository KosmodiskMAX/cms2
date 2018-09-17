<?php require_once("init.php");

$user = new User();

    if(isset($_POST['image_name'])){
        $user->ajax_save($_POST['image_name'],$_POST['user_id']);
    }

?>