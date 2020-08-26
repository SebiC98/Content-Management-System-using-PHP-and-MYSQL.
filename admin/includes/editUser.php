<?php


if($_GET['editUser']){
    echo $theUserId = $_GET['editUser'];
}

if (isset($_POST['editUser'])) {
    $userFirstname = $_POST['userFirstname'];
    $userLastname = $_POST['userLastname'];
    $userRole = $_POST['userRole'];
    $userName = $_POST['userName'];

    // $postImage = $_FILES['image']['name'];
    // $postImageTemp = $_FILES['image']['tmp_name'];

    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['password'];
    //  $postCommentCount = 4;
    // $postDate = date('d-m-y');

    // move_uploaded_file($postImageTemp, "../images/$postImage");

    $query = "INSERT INTO users(userName, userPassword, userFirstname, userLastname, userEmail, userRole) ";
    $query .="VALUES('{$userName}','{$userPassword}','{$userFirstname}','{$userLastname}','{$userEmail}','{$userRole}') ";

    $createUserQuery = mysqli_query($connection, $query);

    confirmQuery($createUserQuery);
}


?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" class="form-control" name="userFirstname">
    </div>
    <div class="form-group">
        <label for="lastName">Last Name</label>
        <input type="text" class="form-control" name="userLastname">
    </div>
    <div class="form-group">
        <select name="userRole" id="">
        <option value="subscriber">Select Option</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>


        </select>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="userName">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="userEmail">
    </div>
    <!-- <div class="form-group">
        <label for="postImage">Post Image</label>
        <input type="file" name="image">
    </div> -->
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="editUser" value="Edit User">
    </div>
</form>