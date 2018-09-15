<?php include("includes/header.php"); ?>

<?php

    if(empty($_GET['id'])){
        redirect("users.php");
    }

    $comment = Comment::find_by_id($_GET['id']);
    if($comment){
        $comment->delete();
        $session->message("The comment with {$comment->id} has been deleted");
    }
    if(empty($_GET['pid'])){
        redirect("comments.php");
    }else{
        redirect("comments.php?id={$_GET['pid']}");
    }
?>