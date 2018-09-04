<?php

function escape($string){
    global $connection;
    mysqli_real_escape_string($connection, trim(($string)));
}


function users_online(){
    
    if(isset($_GET['onlineusers'])){
        
    global $connection;
    if(!$connection){
        session_start();
        include("../includes/db.php");
    
    
        $session =session_id();
        $time = time();
        $time_out_in_seconds = 300;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $select = mysqli_query($connection, $query);
        confirm($select);
        $count = mysqli_num_rows($select);
        if($count == NULL){
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
        }else{
            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
        }
        $query = "SELECT * FROM users_online WHERE time > $time_out"; 
        $select = mysqli_query($connection, $query);
        confirm($select);
        echo $count_users = mysqli_num_rows($select);
    }
}}//get request is set 

users_online();

function confirm($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

function insert_categories(){
    
    global $connection;
    
    if(isset($_POST['submit'])){

    $cat_title = $_POST['cat_title'];
    if($cat_title == "" || empty($cat_title)){
        echo "This field should not be empty";
    } else {
        $query = "INSERT INTO categories(cat_title) ";
        $query.= "VALUE('{$cat_title}') ";
        $create = mysqli_query($connection, $query);

        if(!$create){
            die("Query FAILED". mysqli_error($connection));
        }
    }
    }
}

function findAllCategories(){
    global $connection;

    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";                                    
        echo "</tr>";
    }
    
}

function DeleteCategories(){
    global $connection;
    
    if(isset($_GET['delete'])){
        $re_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE ";
        $query.= "cat_id = {$re_cat_id} ";
        $remove_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }     
}

?>