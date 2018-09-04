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

                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = 1;
                    }    
                    $per_page = 5; //posts per page
                    $page_1 = ($page * $per_page) - $per_page;
                   
                
                    $query = "SELECT * FROM posts";
                    $result = mysqli_query($connection, $query);
                    $count = mysqli_num_rows($result);
                
                    $count = ceil($count/$per_page);
                    
                
                    $query = "SELECT * FROM posts WHERE post_status like 'published' LIMIT $page_1, $per_page ";
                    $result = mysqli_query($connection, $query);
                
                    while ($row = mysqli_fetch_assoc($result)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'], 0, 200);
                        $post_status = $row['post_status'];
                        
                        
                        
                    
                    ?>


                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?> PM</p>
                <hr>
                    <a href="post.php?p_id=<?php echo $post_id ?>">
                        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    </a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>                   
                <?php      
                }
                if(!$count){
                    echo "<h1 class='text-center'> NO POST SORRY</h1>";
                }
                ?>
                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
        <ul class="pager">
            <?php   
                for($i=1; $i<=$count; $i++){
                    if($i==$page){
                        echo "<li><a class='active_link' href='index.php?page={$i}'>$i</a></li>";
                    }else{
                        echo "<li><a href='index.php?page={$i}'>$i</a></li>"; 
                    }
                }
            ?>    
        </ul>

<?php include "includes/footer.php"; ?>