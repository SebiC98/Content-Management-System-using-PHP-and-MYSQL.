<?php


if ($_GET['editUser']) {
    $theUserId = $_GET['editUser'];

    $query = "SELECT * FROM users WHERE userId = $theUserId";
    $selectUsersQuery = mysqli_query($connection, $query);
    confirmQuery($selectUsersQuery);

    while ($row = mysqli_fetch_assoc($selectUsersQuery)) {
        $userId = $row['userId'];
        $userName = $row['userName'];
        $userPassword = $row['userPassword'];
        $userFirstname = $row['userFirstname'];
        $userLastname = $row['userLastname'];
        $userEmail = $row['userEmail'];
        $userRole = $row['userRole'];
        $userImage = $row['userImage'];
    }
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

    $query = "UPDATE users SET ";
    $query .="userFirstname = '{$userFirstname}', ";
    $query .="userLastname = '{$userLastname}', "; 
    $query .="userRole = '{$userRole}', ";
    $query .="userName = '{$userName}', ";
    $query .="userEmail = '{$userEmail}', ";
    $query .="userPassword = '{$userPassword}' ";
    $query .="WHERE userId = {$theUserId} "; 

    $updateUserQuery = mysqli_query($connection,$query);

   confirmQuery($updateUserQuery);
}


?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" value="<?php echo $userFirstname; ?>" class="form-control" name="userFirstname">
    </div>
    <div class="form-group">
        <label for="lastName">Last Name</label>
        <input type="text" value="<?php echo $userLastname; ?>" class="form-control" name="userLastname">
    </div>
    <div class="form-group">
        <select name="userRole" id="">
            <option value="subscriber"><?php echo $userRole; ?></option>
            <?php
            if ($userRole == 'admin') {
                echo "<option value='subscriber'>subscriber</option>";
            } else {
                echo "<option value='admin'>admin</option>";
            }

            ?>





        </select>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" value="<?php echo $userName; ?>" class="form-control" name="userName">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" value="<?php echo $userEmail; ?>" class="form-control" name="userEmail">
    </div>
    <!-- <div class="form-group">
        <label for="postImage">Post Image</label>
        <input type="file" name="image">
    </div> -->
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" value="<?php echo $userPassword; ?>" class="form-control" name="password">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="editUser" value="Edit User">
    </div>
</form>