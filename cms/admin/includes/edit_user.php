<?php 


    if(isset($_GET['edit_user'])){
        
    $user_id = $_GET['edit_user'];
    

    $query = "SELECT * FROM users WHERE user_id = $user_id ";
    $result = mysqli_query($connection, $query);
    confirm($result);

    $row = mysqli_fetch_assoc($result);
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $user_role = $row['user_role'];
    $user_image = $row['user_image'];
    $username = $row['username'];
    $user_email = $row['user_email'];

    if(isset($_POST['edit_user'])){
        

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $user_role = $_POST['user_role'];
        
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        
        $firstname  = mysqli_real_escape_string($connection, $firstname);
        $lastname   = mysqli_real_escape_string($connection, $lastname);
        $user_role  = mysqli_real_escape_string($connection, $user_role);
        $user_image = mysqli_real_escape_string($connection, $user_image);
        $username   = mysqli_real_escape_string($connection, $username);
        $email      = mysqli_real_escape_string($connection, $email);
        $user_password   = mysqli_real_escape_string($connection, $user_password);
        
        if(!empty($user_password)){
            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12) );

            move_uploaded_file($user_image_temp, "../images/$user_image");

            $query = "UPDATE users SET ";
            $query.= "firstname = '{$firstname}', ";
            $query.= "lastname = '{$lastname}', ";
            $query.= "user_role = '{$user_role}', ";
            if(!empty($user_image)){
                $query.= "user_image = '{$user_image}', ";    
            }
            $query.= "username = '{$username}', ";
            $query.= "user_email = '{$user_email}', ";

            $query.= "user_password = '{$user_password}' ";  
            $query.= "WHERE user_id = {$user_id} ";

            $result = mysqli_query($connection, $query);
            confirm($result);
            header("Location: users.php");
        }else{
            header("Location: users.php?source=edit_user&edit_user=$user_id&error=");
        }
    }  
}else{
        header("Location: ../index.php");
        
}
?>
  

   
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
        <select name="user_role" id="user_role">
            <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
            <?php
                if($user_role == 'admin'){
                    echo "<option value='user'>User</option>";
                }else{
                    echo "<option value='admin'>Admin</option>";
                }
            ?>
        </select>      
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