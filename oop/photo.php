<?php include("includes/header.php"); ?>
<?php
if(empty($_GET['id'])){
    redirect("index.php");
}else{
    $photo = Photo::find_by_id($_GET['id']);
}

if(isset($_POST['submit'])){

    $body   = trim($_POST['body']);
    
    $new_comment = Comment::create_comment($photo->id, $session->user_id, $body);
    
    if($new_comment && $new_comment->save()){
        redirect("photo.php?id={$photo->id}");
    }else{
        $message = "There was some problems saving";
    }
}else{
    $author = "";
    $body = "";
}
$comments = Comment::find_the_comments($photo->id);
?>

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-12 row">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Superman</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="admin/<?php echo $photo->picture_path() ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $photo->caption ?></p>
                <p><?php echo $photo->description ?></p>
                <!-- Blog Comments -->
                
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="body"></textarea>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                
                <?php 
                foreach($comments as $comment):
                $user = User::find_by_id($comment->user_id);
                ?>
                
                
                <div class="media">
                    <a href="#" class="pull-left">
                        <img width="64" height="64" src="<?php echo 'admin'.DS.$user->image_path_and_placeholder() ?>" alt="" class="media-object">
                    </a>
                    <div class="media-body">
                       <h4 class="media-heading"><?php echo $user->username ?>
                        <small>August 25, 2030 at 9:30 Pm</small>
                       </h4>
                        <?php echo $comment->body ?>    
                    </div>
                    
                </div>
                <?php endforeach;?>
    

            </div>

            <!-- Blog Sidebar Widgets Column -->
<!--
            <div class="col-md-4">

            <?php// include("includes/sidebar.php"); ?>

            </div>
-->

        </div>
        <!-- /.row -->

<?php include("includes/footer.php"); ?>
