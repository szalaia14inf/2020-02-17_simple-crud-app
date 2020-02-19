<!-- PHP code to read records will be here -->

<?php

// include database connection
include_once 'Config/database.php';

// delete message prompt will be here

$action = isset($_GET['action']) ? $_GET['action'] : "";

// if it was redirected from delete.php
if ($action == 'deleted') {
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}

// select all data
$query =
    "SELECT id, name, description, price 
         FROM products 
         ORDER BY id ASC";
$stmt = $con->prepare($query);
$stmt->execute();

// this is how to get number of rows returned
$num = $stmt->rowCount();

?>

<!DOCTYPE html>
<html>

<head>

    <title>PDO - Read Records - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>

    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>Read Products</h1>
        </div>

        <!-- create new product button -->
        <a href="create.php" class="btn btn-primary m-b-1em">Create New Product</a>

        <table class="table table-hover table-responsive table-bordered">

            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Action</th>
            </tr>

            <!-- table body will be here -->
            <?php
            // retrieve our table contents
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :

                //extract row: this will make $row['firstname'] to just $firstname only
                extract($row); ?>

                <!-- creating new table row per record -->
                <tr>
                    <td><?= $id ?></td>
                    <td><?= $name ?></td>
                    <td><?= $description ?></td>
                    <td>$<?= $price ?></td>
                    <td>
                        <!-- read one record  -->
                        <a href="read_one.php?id=<?= $id ?>" class="btn btn-info m-r-1em">Read</a>

                        <!-- we will use this links on next part of this post -->
                        <a href="update.php?id=<?= $id ?>" class="btn btn-primary m-r-1em">Edit</a>

                        <!-- we will use this links on next part of this post -->
                        <a href="#" onclick="delete_user(<?= $id ?>);" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table> <!-- end table -->

        <!-- check if more than 0 record found -->
        <?php if ($num > 0) : ?>


            <!-- data from database will be here -->

        <?php else : ?>

            <!-- if no records found -->
            <div class="alert alert-danger">No records found.</div>
        <?php endif; ?>

    </div> <!-- end .container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->
    <script>
        // confirm record deletion
        function delete_product(id) {

            var answer = confirm('Are you sure?');
            if (answer) {
                // if user clicked ok, pass the id to delete.php and execute the delete query
                window.location = 'delete.php?id=' + id;
            }
        }
    </script>

</body>

</html>