<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Menu Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            width: 1200px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Menu Details</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New
                            Menu</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM orders";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Order ID</th>";
                            echo "<th>Serving Method</th>";
                            echo "<th>User ID</th>";
                            echo "<th>Time & Date</th>";
                            echo "<th>Total Price</th>";
                            echo "<th>Delivery Address</th>";
                            echo "<th>Payment Method</th>";
                            echo "<th>Transaction ID</th>";
                            echo "<th>Product ID</th>";
                            echo "<th>Quantity</th>";
                            echo "<th>Subtotal</th>";
                            echo "<th>Delivery Charge</th>";
                            echo "<th>Store ID</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['order_id'] . "</td>";
                                echo "<td>" . $row['serving_method'] . "</td>";
                                echo "<td>" . $row['user_id'] . "</td>";
                                echo "<td>" . $row['timedate'] . "</td>";
                                echo "<td>" . $row['total_price'] . "</td>";
                                echo "<td>" . $row['delivery_address'] . "</td>";
                                echo "<td>" . $row['payment_method'] . "</td>";
                                echo "<td>" . $row['transaction_id'] . "</td>";
                                echo "<td>" . $row['product_id'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td>" . $row['subtotatl'] . "</td>";
                                echo "<td>" . $row['delivery_charge'] . "</td>";
                                echo "<td>" . $row['store_id'] . "</td>";
                                echo "<td>";
                                echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>