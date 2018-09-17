<?php require_once("includes/header.php"); ?>


<?php
    

    if($session->is_signed_in()) {redirect("index.php");}


    if(isset($_POST['submit'])){
        
        $username = trim($_POST['username']);
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $password = trim($_POST['password']);
        
        if(empty($username) || empty($firstname) || empty($lastname) || empty($password)){
            $the_message = "Username or password can't be empty";
        }else{
            $sql = "SELECT * FROM users WHERE username like '$username' ";
            $user_found = User::find_by_query($sql);
            if($user_found){
                $the_message = "This username already exists";
            }else{
                $user = new User;
                $user->username = $username;
                $user->firstname = $firstname;
                $user->lastname  = $lastname;
                $user->password = $password;
                $user->create();
                redirect("login.php");
            }
        }
    }else{
        $the_message = "";
        $username = "";
        $firstname = "";
        $lastname = "";
        $password = "";
    }


?>



<div class="col-md-4 col-md-offset-4">

    <h4 class="bg-danger"><?php echo $the_message; ?></h4>

    <form id="login-id" action="" method="post">

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >

        </div>
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" name="firstname" value="<?php echo htmlentities($firstname); ?>" >

        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" name="lastname" value="<?php echo htmlentities($lastname); ?>" >

        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">

        </div>


        <div class="form-group">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-block">

        </div>


    </form>


</div>