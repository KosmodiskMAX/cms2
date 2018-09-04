<?php 
    if(isset($_POST['create_user'])){
        

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $user_role = $_POST['user_role'];
        
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        
        $user_password   = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12) );
        move_uploaded_file($user_image_temp, "../images/$user_image");
        
        
        $query = "INSERT INTO users (username, user_password, firstname, lastname, user_email, user_image, user_role) ";
        $query.= "VALUES('{$username}','{$user_password}','{$firstname}','{$lastname}', '{$user_email}', '{$user_image}', '{$user_role}')";
        
        $result = mysqli_query($connection, $query);
        confirm($result);
        
        header("Location: users.php");
    }
?>
  

   
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="firstname">        
    </div>
    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="lastname">        
    </div>
    <div class="form-group">
        <select name="user_role" id="user_role">
            <option value="user">Select Option</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>      
    </div>


    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="image">        
    </div>

    
    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="username">        
    </div>
    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" class="form-control" name="user_email">      
    </div>
    <div class="form-group">
        <label for="post_content">Pssword</label>
        <input type="password" class="form-control" name="user_password">      
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>  
</form>