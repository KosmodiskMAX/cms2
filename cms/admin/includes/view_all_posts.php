<?php
    
    if(isset($_POST['checkBoxArray'])){ 
        foreach($_POST['checkBoxArray'] as $checkBox){
            $bulk_options = $_POST['bulk_options'];
            switch($bulk_options){
                
                case 'clone': 
                    $query = "SELECT * FROM posts WHERE post_id = $checkBox";
                    $select = mysqli_query($connection, $query);
                    confirm($select);
                    
                    $row = mysqli_fetch_assoc($select);
                        
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                    $post_date = $row['post_date'];
                    
                    $query = "INSERT INTO posts(post_category_id, post_title, post_author, ";
                    $query.= "post_date, post_image, post_content, post_tags, post_status) ";
                    $query.= "VALUES({$post_category_id},'{$post_title}','{$post_author}', now(),'{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

                    $result = mysqli_query($connection, $query);
                    confirm($result);
                    header("Location: posts.php");
                    
                break;     
                case 'published': 
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id=$checkBox";
                    $update = mysqli_query($connection, $query);
                    confirm($update);
                break;
                case 'draft': 
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id=$checkBox";
                    $update = mysqli_query($connection, $query);
                    confirm($update);
                break;
                case 'delete': 
                    $query = "DELETE FROM posts WHERE post_id = $checkBox";
                    $delete = mysqli_query($connection, $query);
                    confirm($delete);
                break;
                    
            }
        }
        
    }

?>

<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4" style="padding:0;">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="clone">Clone</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>
    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Views</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)){
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_views_count'];
                echo "<tr>";
                echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value=$post_id></td>";
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_author}</td>";
                echo "<td>{$post_title}</td>";

                $query = "SELECT * FROM categories where cat_id={$post_category_id}";
                $select = mysqli_query($connection, $query);

                confirm($select);

                $row = mysqli_fetch_assoc($select);
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<td>{$cat_title}</td>";


                echo "<td>{$post_status}</td>";
                echo "<td><img width=100 src='../images/{$post_image}' alt='image'></td>";
                echo "<td>{$post_tags}</td>";
                
                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $select = mysqli_query($connection, $query);
                confirm($select);

                $count_comments = mysqli_num_rows($select);
                
                echo "<td><a href='comments.php?source=post_comments&p_id=$post_id'>{$count_comments}</a></td>";
                
                echo "<td>{$post_date}</td>";
                echo "<td>{$post_views_count}</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Update</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete') \" href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "</tr>";
            }
        ?>                     
    </tbody>
    </table>
</form>

<?php 

if(isset($_GET['delete'])){
    $post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$post_id} ";
    $delete_query = mysqli_query($connection, $query);
    confirm($delete_query);
    header("Location: posts.php");
}


?>