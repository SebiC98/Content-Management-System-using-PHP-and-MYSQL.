<?php

if (isset($_POST['createPost'])) {
    $postTitle = $_POST['title'];
    $postCategoryId = $_POST['postCategory'];
    $postAuthor = $_POST['author'];
    $postStatus = $_POST['postStatus'];

    $postImage = $_FILES['image']['name'];
    $postImageTemp = $_FILES['image']['tmp_name'];

    $postTags = $_POST['postTags'];
    $postContent = $_POST['postContent'];
    //  $postCommentCount = 4;
    $postDate = date('d-m-y');

    move_uploaded_file($postImageTemp, "../images/$postImage");

    $query = "INSERT INTO posts(postCategoryId, postTitle, postAuthor, postDate, postImage, postContent, postTags, postStatus) VALUES({$postCategoryId},'{$postTitle}','{$postAuthor}',now(),'{$postImage}','{$postContent}','{$postTags}','{$postStatus}') ";

    $createPostQuery = mysqli_query($connection, $query);

    confirmQuery($createPostQuery);
}


?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
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
    </div>
    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="postStatus">Post Status</label>
        <input type="text" class="form-control" name="postStatus">
    </div>
    <div class="form-group">
        <label for="postImage">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="postTags">Post Tags</label>
        <input type="text" class="form-control" name="postTags">
    </div>
    <div class="form-group">
        <label for="postContent">Post Content</label>
        <textarea class="form-control" name="postContent" id="" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="createPost" value="Publish Post">
    </div>
</form>