<?php include "includes/adminHeader.php"; ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/adminNavigation.php"; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>
                        <div class="col-xs-6">
                            <?php
                            if (isset($_POST['submit'])){
                                $categoryTitle = $_POST['catTitle'];

                                if($categoryTitle == "" || empty($categoryTitle)){
                                    echo "This field should not be empty!";
                                }else{
                                    $query = "INSERT INTO categories(categoryTitle) ";
                                    $query .="VALUE('{$categoryTitle}')";

                                    $createCategoryQuery = mysqli_query($connection, $query);

                                    if(!$createCategoryQuery){
                                        die("QUERY FAILED!".mysqli_error($connection));
                                    }
                                }
                            }
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="catTitle">Add Category</label>
                                    <input type="text" class="form-control" name="catTitle">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-6">
                            <?php
                        $query = "SELECT * FROM categories";
                        $selectCategories = mysqli_query($connection, $query);
                            ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($selectCategories)) {
                                        $categoryId = $row['categoryId'];
                                        $categoryTitle = $row['categoryTitle'];
                                        echo "<tr><td>{$categoryId}</td>";
                                        echo "<td>{$categoryTitle}</td></tr>";
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include "includes/adminFooter.php"; ?>