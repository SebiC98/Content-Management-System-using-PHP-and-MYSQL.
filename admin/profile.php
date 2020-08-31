<?php include "includes/adminHeader.php"; ?>
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

                        if (isset($_POST['updateProfile'])) {
                            $userFirstname = $_POST['userFirstname'];
                            $userLastname = $_POST['userLastname'];

                            $userName = $_POST['userName'];

                            // $postImage = $_FILES['image']['name'];
                            // $postImageTemp = $_FILES['image']['tmp_name'];

                            $userEmail = $_POST['userEmail'];
                            $userPassword = $_POST['password'];
                            

                            //  $postCommentCount = 4;
                            // $postDate = date('d-m-y');

                            // move_uploaded_file($postImageTemp, "../images/$postImage");
                            if (!empty($userPassword)) {
                                $userPassword = password_hash($userPassword, PASSWORD_BCRYPT, array('cost' => 10));
                                $query = "UPDATE users SET ";
                                $query .= "userFirstname = '{$userFirstname}', ";
                                $query .= "userLastname = '{$userLastname}', ";
                                $query .= "userName = '{$userName}', ";
                                $query .= "userEmail = '{$userEmail}', ";
                                $query .= "userPassword = '{$userPassword}' ";
                                $query .= "WHERE userName = '{$username}' ";

                                $updateUserQuery = mysqli_query($connection, $query);

                                confirmQuery($updateUserQuery);
                                echo "User Updated " . "<a href='users.php'>View Users</a>";
                            } else {
                                echo "User Not Updated " . "<a href='users.php'>View Users</a>";
                            }
                        }
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
                            <input autocomplete="off" type="password" class="form-control" name="password">
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