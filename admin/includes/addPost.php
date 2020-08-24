<?php

if(isset($_POST['createPost'])){
    $postTitle = $_POST['title'];
    $postCategoryId = $_POST['postCategoryId'];
    $postAuthor = $_POST['author'];
    $postStatus = $_POST['postStatus'];

    $postImage = $_FILES['image']['name'];
    $postImageTemp = $_FILES['image']['tmp_name'];
    
    $postTags = $_POST['postTags'];
    $postContent = $_POST['postContent'];
    $postCommentCount = 4;
    $postDate = date('d-m-y');

    move_uploaded_file($postImageTemp,"../images/$postImage" );

}

?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="postCategory">Post Category Id</label>
        <input type="text" class="form-control" name="postCategoryId">
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