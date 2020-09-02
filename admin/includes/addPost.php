<?php

if (isset($_POST['createPost'])) {
    $postTitle = escape($_POST['title']);
    $postCategoryId = escape($_POST['postCategory']);
    $postUser = escape($_POST['postUser']);
    $postStatus = escape($_POST['postStatus']);

    $postImage = $_FILES['image']['name'];
    $postImageTemp = $_FILES['image']['tmp_name'];

    $postTags = $_POST['postTags'];
    $postContent = $_POST['postContent'];
    //  $postCommentCount = 4;
    $postDate = date('d-m-y');

    move_uploaded_file($postImageTemp, "../images/$postImage");

    $query = "INSERT INTO posts(postCategoryId, postTitle, postUser, postDate, postImage, postContent, postTags, postStatus) VALUES({$postCategoryId},'{$postTitle}','{$postUser}',now(),'{$postImage}','{$postContent}','{$postTags}','{$postStatus}') ";

    $createPostQuery = mysqli_query($connection, $query);

    confirmQuery($createPostQuery);

    $theGetPostId = mysqli_insert_id($connection);

    echo "<p class='bg-success'>Post Created. <a href='../post.php?pId={$theGetPostId}'>View Post</a> or <a href='posts.php'>Edit More Posts</a> </p>";
}


?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="category">Category</label>
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
        <label for="title">Users</label>
        <select name="postUser" id="postUser">

            <?php
            $query = "SELECT * FROM users";
            $selectUsers = mysqli_query($connection, $query);

            confirmQuery($selectUsers);

            while ($row = mysqli_fetch_assoc($selectUsers)) {
                $userId = $row['userId'];
                $userName = $row['userName'];
                echo "<option value='{$userName}'>{$userName}</option>";
            }


            ?>
        </select>
    </div>
    <div class="form-group">
        <select name="postStatus" id="">
            <option value="draft">Post Status</option>
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
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
        <textarea class="form-control" name="postContent" id="body" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="createPost" value="Publish Post">
    </div>
</form>