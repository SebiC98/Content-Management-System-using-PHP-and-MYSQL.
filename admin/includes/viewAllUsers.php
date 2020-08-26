<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>

    <tbody>
        <?php

        $query = "SELECT * FROM users";
        $selectUsers = mysqli_query($connection, $query);
        confirmQuery($selectUsers);

        while ($row = mysqli_fetch_assoc($selectUsers)) {
            $userId = $row['userId'];
            $userName = $row['userName'];
            $userPassword = $row['userPassword'];
            $userFirstname = $row['userFirstname'];
            $userLastname = $row['userLastname'];
            $userEmail = $row['userEmail'];
            $userRole = $row['userRole'];
            $userImage = $row['userImage'];
    



            echo "<tr>";
            echo "<td>$userId</td>";
            echo "<td>$userName</td>";
            echo "<td>$userFirstname</td>";

            // $query = "SELECT * FROM categories WHERE categoryId = $postCategoryId";
            // $selectCategoriesId = mysqli_query($connection, $query);
            // confirmQuery($selectCategoriesId);
            // while ($row = mysqli_fetch_assoc($selectCategoriesId)) {
            //     $categoryTitle = $row['categoryTitle'];
            // }

            echo "<td>$userLastname</td>";
            echo "<td>$userEmail</td>";
            echo "<td>$userRole</td>";
    

            // $query = "SELECT * FROM posts where postId = $commentPostId";
            // $selectPostIdQuery = mysqli_query($connection, $query);
            // confirmQuery($selectPostIdQuery);
            // while ($row = mysqli_fetch_assoc($selectPostIdQuery)) {
            //     $postId = $row['postId'];
            //     $postTitle = $row['postTitle'];

            //     echo "<td><a href='../post.php?pId=$postId'>$postTitle</a></td>";
            // }



            echo "<td><a href='users.php?changeToAdmin={$userId}'>Admin</a></td>";
            echo "<td><a href='users.php?changeToSubscriber={$userId}'>Subscriber</a></td>";
            echo "<td><a href='users.php?source=editUser&editUser={$userId}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$userId}'>Delete</a></td>";
            echo "</tr>";
        }





        ?>

    </tbody>
</table>

<?php
if (isset($_GET['changeToAdmin'])) {

    $theUserId = $_GET['changeToAdmin'];

    $query = "UPDATE users SET userRole = 'admin' WHERE userId = '$theUserId' ";
    $changeToAdminQuery = mysqli_query($connection, $query);
    confirmQuery($changeToAdminQuery);
    header("Location: users.php");
}

if (isset($_GET['changeToSubscriber'])) {

    $theUserId = $_GET['changeToSubscriber'];

    $query = "UPDATE users SET userRole = 'subscriber' WHERE userId = '$theUserId' ";
    $changeToSubscriberQuery = mysqli_query($connection, $query);
    confirmQuery($changeToSubscriberQuery);
    header("Location: users.php");
}


if (isset($_GET['delete'])) {

    $theUserId = $_GET['delete'];
    $query = "DELETE FROM users WHERE userId = {$theUserId}";

    $deleteUser = mysqli_query($connection, $query);

    confirmQuery($deleteUser);




    header("Location: users.php");
}


?>