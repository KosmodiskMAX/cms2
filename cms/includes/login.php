<?php include "db.php"; ?>
<?php session_start(); ?>

<?php

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password']; 
    
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select = mysqli_query($connection, $query);
    if(!$select){
        die("Query failed". mysqli_error($connection));
    }
    
    while($row = mysqli_fetch_assoc($select)){
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['user_password'];
        $db_firstname = $row['firstname'];
        $db_lastname = $row['lastname'];
        $db_role = $row['user_role'];
    }
    
    
    if(password_verify($password,$db_password)){
        
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_firstname;
        $_SESSION['lastname'] = $db_lastname;
        $_SESSION['role'] = $db_role;
        
        header("Location: ../admin/index.php");  
        
    } else {
        header("Location: ../index.php");
    }
    
}

?>