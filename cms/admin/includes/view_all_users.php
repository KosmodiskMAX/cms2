<table class="table table-bordered table-hover">
<thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Image</th>
        <th>Email</th>
        <th>Role</th>       
    </tr>
</thead>
<tbody>
    <?php 
        $query = "SELECT * FROM users";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            
            
            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$firstname}</td>";
            echo "<td>{$lastname}</td>";
            echo "<td><img width=100 src='../images/{$user_image}' alt='image'></td>";
            echo "<td>{$email}</td>";
            echo "<td>{$user_role}</td>";
            echo "<td><a href='users.php?change_to_admin={$user_id}'>Promote to Admin</a></td>";
            echo "<td><a href='users.php?change_to_user={$user_id}'>Change to User</a></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";
        }
    ?>                          
</tbody>

</table>


<?php 
if(isset($_GET['change_to_admin'])){
    $user_id = $_GET['change_to_admin'];
    
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $user_id ";
    $update_query = mysqli_query($connection, $query);
    confirm($update_query);
    header("Location: users.php");
}
if(isset($_GET['change_to_user'])){
    $user_id = $_GET['change_to_user'];
    
    $query = "UPDATE users SET user_role = 'user' WHERE user_id = $user_id ";
    $update_query = mysqli_query($connection, $query);
    confirm($update_query);
    header("Location: users.php");
}
if(isset($_GET['delete'])){
    
    if(isset($_SESSION['role'])){
        $role = $_SESSION['role'];
        if($role == 'admin'){
            $user_id = mysqli_real_escape_string($connection, $_GET['delete']);
            $query = "DELETE FROM users WHERE user_id = {$user_id} ";
            $delete_query = mysqli_query($connection, $query);
            confirm($delete_query);
            header("Location: users.php");
        }
    }
}
?>