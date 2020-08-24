<?php

if (isset($_GET['pId'])) {
    $theGetPostId = $_GET['pId'];
}

$query = "SELECT * FROM posts WHERE postId = $theGetPostId";
$selectPostsById = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($selectPostsById)) {
    $postId = $row['postId'];
    $postCategoryId = $row['postCategoryId'];
    $postTitle = $row['postTitle'];
    $postAuthor = $row['postAuthor'];
    $postDate = $row['postDate'];
    $postImage = $row['postImage'];
    $postContent = $row['postContent'];
    $postTags = $row['postTags'];
    $postCommentCount = $row['postCommentCount'];
    $postStatus = $row['postStatus'];
}

if(isset($_POST['updatePost'])){
    //THESE ARE THE NAMES FROM name of the option
     $postAuthor = $_POST['author']; //author from options
     $postTitle = $_POST['title']; //title from option 
     $postCategoryId = $_POST['postCategory'];//postCategory from the SELECT line 63
     $postStatus = $_POST['postStatus'];
     $postImage = $_FILES['image']['name'];
     $postImageTemp = $_FILES['image']['tmp_name'];
     $postContent = $_POST['postContent'];
     $postTags = $_POST['postTags'];

     move_uploaded_file($postImageTemp, "../images/$postImage");


     if(empty($postImage)){
         $query = "SELECT * FROM posts WHERE postId = $theGetPostId ";
         $selectImage = mysqli_query($connection,$query);
         while($row=mysqli_fetch_array($selectImage)){
             $postImage = $row['postImage'];
         }
     }

     $query = "UPDATE posts SET ";
     $query .="postTitle = '{$postTitle}', ";
     $query .="postCategoryId = '{$postCategoryId}', "; 
     $query .="postDate = now(), ";
     $query .="postAuthor = '{$postAuthor}', ";
     $query .="postStatus = '{$postStatus}', ";
     $query .="postTags = '{$postTags}', ";
     $query .="postContent = '{$postContent}', ";
     $query .="postImage = '{$postImage}' ";
     $query .="WHERE postId = {$theGetPostId} "; 

     $updatePostQuery = mysqli_query($connection,$query);

    confirmQuery($updatePostQuery);


}
?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $postTitle; ?>" type="text" class="form-control" name="title">
    </div>

    <select name="postCategory" id="postCategory"> 

        <?php
        $query = "SELECT * FROM categories";
        $selectCategories = mysqli_query($connection, $query);

        confirmQuery($selectCategories);

        while ($row = mysqli_fetch_assoc($selectCategories)) {
            $categoryId = $row['categoryId'];
            $categoryTitle = $row['categoryTitle'];

            echo "<option value='{$categoryId}'>{$categoryTitle}</option>";
        }


        ?>


    </select>
    <div class="form-group">
        <label for="title">Post Author</label>
        <input value="<?php echo $postAuthor; ?>" type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="postStatus">Post Status</label>
        <input value="<?php echo $postStatus; ?>" type="text" class="form-control" name="postStatus">
    </div>
    <div class="form-group">
        <img width="100" src="../images/<?php echo $postImage; ?>" alt="">
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="postTags">Post Tags</label>
        <input value="<?php echo $postTags; ?>" type="text" class="form-control" name="postTags">
    </div>
    <div class="form-group">
        <label for="postContent">Post Content</label>
        <textarea class="form-control" name="postContent" id="" cols="30" rows="10"><?php echo $postContent; ?></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="updatePost" value="Update Post">
    </div>
</form>