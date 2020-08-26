<?php include "db.php"; ?>
<?php session_start(); ?>

<?php

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE userName = '{$username}' ";
    $selectUserQuery = mysqli_query($connection, $query);
    if (!$selectUserQuery) {
        die("QUERY FAILED " . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($selectUserQuery)) {
        $dbUserId = $row['userId'];
        $dbUserName = $row['userName'];
        $dbUserPassword = $row['userPassword'];
        $dbUserFirstname = $row['userFirstname'];
        $dbUserLastname = $row['userLastname'];
        $dbUserRole = $row['userRole'];
    }

    if ($username === $dbUserName && $password === $dbUserPassword) {

        $_SESSION['username'] = $dbUserName;
        $_SESSION['firstname'] = $dbUserFirstname;
        $_SESSION['lastname'] = $dbUserLastname;
        $_SESSION['role'] = $dbUserRole;
        
        header("Location: ../admin/admin.php");
    } else
        header("Location: ../index.php");
}
?>