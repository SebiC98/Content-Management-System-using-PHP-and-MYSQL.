<?php include "includes/adminHeader.php"; ?>

<?php if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];

    $query = "SELECT * FROM users where userName = '{$username}' ";

    $selectUserProfile = mysqli_query($connection, $query);

    confirmQuery($selectUserProfile);

    while ($row = mysqli_fetch_array($selectUserProfile)) {

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
?>

<body>
    <?php
    if (isset($_POST['updateProfile'])) {
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
        $query .= "userFirstname = '{$userFirstname}', ";
        $query .= "userLastname = '{$userLastname}', ";
        $query .= "userRole = '{$userRole}', ";
        $query .= "userName = '{$userName}', ";
        $query .= "userEmail = '{$userEmail}', ";
        $query .= "userPassword = '{$userPassword}' ";
        $query .= "WHERE userName = '{$username}' ";

        $updateUserQuery = mysqli_query($connection, $query);

        confirmQuery($updateUserQuery);
    }


    ?>  
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/adminNavigation.php"; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>
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
                                <input class="btn btn-primary" type="submit" name="updateProfile" value="Update Profile">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/adminFooter.php"; ?>