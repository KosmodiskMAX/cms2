<?php include "includes/admin_header.php" ?>
   
<?php
    
?>
   
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                  
                <!-- /.row -->
<!--Admin WIDGET   -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <?php
                        
                        $query = "SELECT * FROM posts";
                        $select = mysqli_query($connection, $query);
                        confirm($select);
                        $post_count = mysqli_num_rows($select);
                        
                        echo "<div class='huge'>{$post_count}</div>";
                    ?>    
                    
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <?php
                        
                        $query = "SELECT * FROM comments";
                        $select = mysqli_query($connection, $query);
                        confirm($select);
                        $comment_count = mysqli_num_rows($select);
                        
                        echo "<div class='huge'>{$comment_count}</div>";
                    ?> 
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        
                        $query = "SELECT * FROM users";
                        $select = mysqli_query($connection, $query);
                        confirm($select);
                        $users_count = mysqli_num_rows($select);
                        
                        echo "<div class='huge'>{$users_count}</div>";
                    ?>                    
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        
                        $query = "SELECT * FROM categories";
                        $select = mysqli_query($connection, $query);
                        confirm($select);
                        $categories_count = mysqli_num_rows($select);
                        
                        echo "<div class='huge'>{$categories_count}</div>";
                    ?>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>  
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
               
<!--               ADMIN WIDGET-->
                <!-- /.row -->
<?php
    $query = "SELECT * FROM posts WHERE post_status = 'published'";
    $select = mysqli_query($connection, $query);
    confirm($select);
    $published_count = mysqli_num_rows($select); 
                
                
    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
    $select = mysqli_query($connection, $query);
    confirm($select);
    $draft_count = mysqli_num_rows($select);

    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
    $select = mysqli_query($connection, $query);
    confirm($select);
    $unapproved_count = mysqli_num_rows($select);

    $query = "SELECT * FROM users WHERE user_role = 'user'";
    $select = mysqli_query($connection, $query);
    confirm($select);
    $user_count = mysqli_num_rows($select);                
                
                
?>
                
                
<div class="row">
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
            
        <?php
            
            $element_text = ['All Posts', 'Active Posts', 'Inactive Posts', 'Comments', 'Pending Comments', 'Total Users', 'Basic Users', 'Categories'];
            $element_count = [$post_count, $published_count, $draft_count, $comment_count, $unapproved_count, $users_count, $user_count, $categories_count];
        for($i = 0; $i < 7; $i++){
            echo "['{$element_text[$i]}',{$element_count[$i]}],";
        }        
            
        ?>
            
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width:'auto'; height: 500px;"></div>   
</div>
           
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
<?php include "includes/admin_footer.php" ?>