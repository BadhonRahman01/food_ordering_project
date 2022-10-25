<?php
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM orders WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set
                 contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field value
                $order_id = $row["order_id"];
                $serving_method = $row["serving_method"];
                $user_id = $row["user_id"];
                $timedate = $row["timedate"];
                $total_price = $row["total_price"];
                $delivery_address = $row["delivery_address"];
                $payment_method = $row["payment_method"];
                $transaction_id = $row["transaction_id"];
                $product_id = $row["product_id"];
                $quantity = $row["quantity"];
                $subtotatl = $row["subtotatl"];
                $delivery_charge = $row["delivery_charge"];
                $store_id = $row["store_id"];
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }

        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Order</h1>
                    <div class="form-group">
                        <label>Order ID</label>
                        <p><b>
                                <?php echo $row["order_id"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Serving Method</label>
                        <p><b>
                                <?php echo $row["serving_method"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>User ID</label>
                        <p><b>
                                <?php echo $row["user_id"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Time & Date</label>
                        <p><b>
                                <?php echo $row["timedate"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Total Price</label>
                        <p><b>
                                <?php echo $row["total_price"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Delivery Address</label>
                        <p><b>
                                <?php echo $row["delivery_address"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Payment Method</label>
                        <p><b>
                                <?php echo $row["payment_method"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Transaction ID</label>
                        <p><b>
                                <?php echo $row["transaction_id"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Product ID</label>
                        <p><b>
                                <?php echo $row["product_id"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <p><b>
                                <?php echo $row["quantity"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Sub Total</label>
                        <p><b>
                                <?php echo $row["subtotatl"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Delivery Charge</label>
                        <p><b>
                                <?php echo $row["delivery_charge"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Store ID</label>
                        <p><b>
                                <?php echo $row["store_id"]; ?>
                            </b></p>
                    </div>

                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>