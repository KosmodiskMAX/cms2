<?php include "includes/admin_header.php" ?>
<?php
 
    
  if(isset($_SESSION['username'])){
     $username = $_SESSION['username'];
      
      $query = "SELECT * FROM users WHERE username = '{$username}' ";
      $select = mysqli_query($connection, $query);
      confirm($select);
      
$row = mysqli_fetch_assoc($select);
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $user_role = $row['user_role'];
    $user_image = $row['user_image'];
    $username = $row['username'];
    $user_email = $row['user_email'];

    if(isset($_POST['edit_user'])){
        

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
        
    $firstname  = mysqli_real_escape_string($connection, $firstname);
    $lastname   = mysqli_real_escape_string($connection, $lastname);
    $user_image = mysqli_real_escape_string($connection, $user_image);
    $username   = mysqli_real_escape_string($connection, $username);
    $user_email      = mysqli_real_escape_string($connection, $user_email);
    $user_password   = mysqli_real_escape_string($connection, $user_password);

    if(!empty($user_password)){
        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12) );

        move_uploaded_file($user_image_temp, "../images/$user_image");

        $query = "UPDATE users SET ";
        $query.= "firstname = '{$firstname}', ";
        $query.= "lastname = '{$lastname}', ";
        if(!empty($user_image)){
            $query.= "user_image = '{$user_image}', ";    
        }
        $query.= "username = '{$username}', ";
        $query.= "user_email = '{$user_email}', ";
        $query.= "user_password = '{$user_password}' ";  
        $query.= "WHERE username = '{$username}' ";

        $result = mysqli_query($connection, $query);
        confirm($result);
        header("Location: index.php");
    }else{
        header("Location: profile.php?error=");
    }
  }  }
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
                       <?php
                        if(isset($_GET['error'])){
                            echo "Password can't be empty";
                        }else{
                            echo "Welcome to admin ";
                            echo "<small>Author</small>";
                        }
                        ?>    
                    </h1>
                    
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input value="<?php echo $firstname?>" type="text" class="form-control" name="firstname">        
                        </div>
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input value="<?php echo $lastname?>" type="text" class="form-control" name="lastname">        
                        </div>
                        <div class="form-group">
                            <img width="100" src="../images/<?php echo $user_image?>" alt="">
                        </div>
                        <div class="form-group">
                            <label for="user_image">User Image</label>
                            <input type="file" name="image">        
                        </div>
                        <div class="form-group">
                            <label for="post_tags">Username</label>
                            <input value="<?php echo $username?>" type="text" class="form-control" name="username">        
                        </div>
                        <div class="form-group">
                            <label for="post_content">Email</label>
                            <input value="<?php echo $user_email?>" type="email" class="form-control" name="user_email">      
                        </div>
                        <div class="form-group">
                            <label for="post_content">Password</label>
                            <input autocomplete="off" type="password" class="form-control" name="user_password">      
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="edit_user" value="Save">
                        </div>  
                    </form>
                   
                </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>