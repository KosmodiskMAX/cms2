<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    <!-- Navigation -->
    
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                 <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>               
                
                <?php
                
                    if(isset($_GET['p_id'])){
                    $the_post_id = $_GET['p_id'];
                        
                    $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
                    $update = mysqli_query($connection, $query);
                    
                       
                
                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                    ?>


                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?> PM</p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>

                <hr>                   
                <?php      
                }
            }
                ?>
                
                
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="Comment">Your comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                    
                    $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                    $query.= "AND comment_status = 'approved' ";
                    $query.= "ORDER BY comment_id DESC ";
                    $select = mysqli_query($connection, $query);
                    if(!$select){
                        die("QUERY FAILED" . mysqli_error($connection));
                    }
                    while ($row = mysqli_fetch_assoc($select)){
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                        $comment_author = $row['comment_author'];            
                ?>

                    <div class="media">


                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author ?>
                                <small><?php echo $comment_date ?></small>
                            </h4>
                            <?php echo $comment_content ?>
                        </div>
                    </div>                       
                       
                        <?php
                    }
               
                ?>
                <!-- Comment -->
                <div class="media">
                           
            
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <!-- Comment -->


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
    <?php //INSERTING COMMENTS
        if(isset($_POST['create_comment'])){

            $the_post_id = $_GET['p_id'];

            $comment_author = $_POST['comment_author'];
            $comment_email = $_POST['comment_email'];
            $comment_content = $_POST['comment_content'];                    

            if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                $query.= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                $result = mysqli_query($connection, $query);
                if(!$result){
                        die("QUERY FAILED" . mysqli_error($connection));
                }


                // Increse comment count
//                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
//                $query.= "WHERE post_id = $the_post_id";
//                $result = mysqli_query($connection, $query);
//                if(!$result){
//                        die("QUERY FAILED" . mysqli_error($connection));
//                }
                //refresh                      
            }
            else{
                echo "<script>alert('Fields cannot be empty');</script>";
            }
        }
    ?>
<?php include "includes/footer.php"; ?>