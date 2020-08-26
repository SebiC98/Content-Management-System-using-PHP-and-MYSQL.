
<?php session_start();?>
<?php
if (!isset($_SESSION['role'])) {

        header("Location: ../index.php");
}
?>
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
                        Welcome to Admin, 
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>



                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/adminFooter.php"; ?>