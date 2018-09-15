<?php include("includes/header.php"); ?>
        
<?php
    $message = "";
    if(isset($_GET['id'])){
        $user = User::find_by_id($_GET['id']);    
    }else{
        redirect("users.php");
    }
    
    if(isset($_POST['update'])){
        if($user){
        $user->username = $_POST['username'];
        $user->firstname = $_POST['firstname'];
        $user->lastname = $_POST['lastname'];
        if(!empty($_POST['password'])){
            $user->password = $_POST['password'];
        }
        if($user->set_file($_FILES['user_image'])){
            echo $user->user_image = $user->filename;
        }
            
        if($user->save()){
            $message = "User created succesfull $user->user_image";
        }else{
            $message = join("<br>", $user->errors);
        }
    }
}


?>
        

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">SB Admin</a>
            </div>
            
            
            <!-- Top Menu Items -->
            <?php include("includes/top_nav.php"); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/side_nav.php"); ?>
            <!-- /.navbar-collapse -->
            
            
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            USERS <?php echo $message; ?>
                            <small>Subheading</small>
                        </h1>
                        <div class="col-md-6">
                            <img class="img-responsive" src="<?php echo $user->image_path_and_placeholder()?>" alt="">
                        </div>
                    <form action="" method=post enctype="multipart/form-data">
                           
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="file" name="user_image" value=""> 
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $user->username?>"> 
                            </div>
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" class="form-control" value="<?php echo $user->firstname?>">    
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" class="form-control" value="<?php echo $user->lastname?>"> 
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" value=""> 
                            </div>
                            <div class="form-group">
                                <a href="delete_user.php?id=<?php echo $user->id?>" class="btn btn-danger">Delete</a>
                                <input type="submit" name="update" class="btn btn-primary pull-right" value="UPDATE"> 
                            </div>
                        </div>

                    </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>