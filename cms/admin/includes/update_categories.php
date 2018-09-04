<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>

        <?php //EDIT
            if(isset($_GET['edit'])){
                $cat_id = $_GET['edit'];
                $query = "SELECT * FROM categories ";
                $query.= "WHERE cat_id = $cat_id";
                $select_edit = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_edit)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
        ?>
        <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" class= "form-control" type="text" name="cat_title">

        <?php    } }?>

        <?php
         if(isset($_POST['update'])){
            $up_cat_id = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title = ";
            $query.= "'{$up_cat_id}' WHERE cat_id='{$cat_id}'  ";
            $update_query = mysqli_query($connection, $query);
            if(!$update_query){
                die("Query Failed". mysqli_error($connection));
            }
            header("Location: categories.php");
         }                        
        ?>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Update Category">
    </div>
</form>