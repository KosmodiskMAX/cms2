<table class="table table-bordered table-hover">
<thead>
    <tr>
        <th>ID</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Reponse to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Edit</th>
        <th>Delete</th>       
    </tr>
</thead>
<tbody>
    <?php 
        if(isset($_GET['source'])){
            $source = $_GET['source'];
            $post_id = $_GET['p_id'];
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
        }else{
            $source = "";
            $query = "SELECT * FROM comments";
        }
    
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)){
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
            
            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";

            $query = "SELECT * FROM posts WHERE post_id={$comment_post_id}";
            $select = mysqli_query($connection, $query);

            confirm($select);



            
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";
            
            $row = mysqli_fetch_assoc($select);
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            
            echo "<td>{$comment_date}</td>";
            echo "<td><a href='comments.php?approved=$comment_id'>Approve</a></td>";
            echo "<td><a href='comments.php?unapproved=$comment_id'>Unapprove</a></td>";
            echo "<td><a href='#'>Edit</a></td>";
            echo "<td><a href='comments.php?source=$source&delete=$comment_id&p_id=$post_id'>Delete</a></td>";
            echo "</tr>";
        }
    ?>                          
</tbody>

</table>


<?php 
if(isset($_GET['approved'])){
    $comment_id = $_GET['approved'];
    
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id ";
    $update_query = mysqli_query($connection, $query);
    confirm($update_query);
    header("Location: comments.php");
}
if(isset($_GET['unapproved'])){
    $comment_id = $_GET['unapproved'];
    
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_id ";
    $update_query = mysqli_query($connection, $query);
    confirm($update_query);
    header("Location: comments.php");
}
if(isset($_GET['delete'])){
    $comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$comment_id} ";
    $delete_query = mysqli_query($connection, $query);
    confirm($delete_query);
    if(isset($_GET['source'])){
        $source = $_GET['source'];
        $post_id = $_GET['p_id'];
        header("Location: comments.php?source=$source&p_id=$post_id");
    }else{
        header("Location: comments.php");
    }
}

?>