<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$order_id = $serving_method = $user_id = $timedate = $total_price = $delivery_address = $payment_method = $transaction_id = $product_id = $quantity = $subtotatl = $delivery_charge = $store_id = "";
$order_id_err = $serving_method_err = $user_id_err = $timedate_err = $total_price_err = $delivery_address_err = $payment_method_err = $transaction_id_err = $product_id_err = $quantity_err = $subtotatl_err = $delivery_charge_err = $store_id_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    // Validate order id
    $input_order_id = trim($_POST["order_id"]);
    if (empty($input_order_id)) {
        $order_id_err = "Please enter order id";
    } elseif (!ctype_digit($input_order_id)) {
        $order_id_err = "Please enter a order id";
    } else {
        $order_id = $input_order_id;
    }

    // Validate serving method
    $input_serving_method = trim($_POST["serving_method"]);
    if (empty($input_serving_method)) {
        $serving_method_err = "Please enter serving method;";
    } elseif (!filter_var($input_serving_method, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $serving_method_err = "Please enter a serving method";
    } else {
        $serving_method = $input_serving_method;
    }

    // Validate user id
    $input_user_id = trim($_POST["user_id"]);
    if (empty($input_user_id)) {
        $user_id_err = "Please enter order id";
    } elseif (!ctype_digit($input_user_id)) {
        $order_id_err = "Please enter a order id";
    } else {
        $user_id = $input_user_id;
    }
    // Validate datetime
    $input_timedate = trim($_POST["timedate"]);
    if (empty($input_timedate)) {
        $timedate_err = "Please enter time and date";
    } else {
        $timedate = $input_timedate;
    }
    // Validate order id
    $input_total_price = trim($_POST["total_price"]);
    if (empty($input_total_price)) {
        $total_price_err = "Please enter total price";
    } else {
        $total_price = $input_total_price;
    }
    // Validate delivery address
    $input_delivery_address = trim($_POST["delivery_address"]);
    if (empty($input_delivery_address)) {
        $delivery_address_err = "Please enter a delivery address";
    } else {
        $delivery_address = $input_delivery_address;
    }
    // Validate payment_method
    $input_payment_method = trim($_POST["payment_method"]);
    if (empty($input_payment_method)) {
        $payment_method_err = "Please enter payment method;";
    } elseif (!filter_var($input_payment_method, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $payment_method_err = "Please enter a payment method";
    } else {
        $payment_method = $input_payment_method;
    }
    // Validate transaction id
    $input_transaction_id = trim($_POST["transaction_id"]);
    if (empty($input_transaction_id)) {
        $transaction_id_err = "Please enter a transaction id";
    } else {
        $transaction_id = $input_transaction_id;
    }
    // Validate product_id
    $input_product_id = trim($_POST["product_id"]);
    if (empty($input_product_id)) {
        $product_id_err = "Please enter product id";
    } elseif (!ctype_digit($input_product_id)) {
        $product_id_err = "Please enter a product id";
    } else {
        $product_id = $input_product_id;
    }
    // Validate quantity
    $input_quantity = trim($_POST["quantity"]);
    if (empty($input_quantity)) {
        $quantity_err = "Please enter quantity";
    } elseif (!ctype_digit($input_quantity)) {
        $quantity_err = "Please enter a quantity";
    } else {
        $quantity = $input_quantity;
    }
    // Validate subtotatl
    $input_subtotatl = trim($_POST["subtotatl"]);
    if (empty($input_subtotatl)) {
        $subtotatl_err = "Please enter subtotal";
    } elseif (!ctype_digit($input_subtotatl)) {
        $subtotatl_err = "Please enter a subtotal";
    } else {
        $subtotatl = $input_subtotatl;
    }

    // Validate order id
    $input_delivery_charge = trim($_POST["delivery_charge"]);
    if (empty($input_delivery_charge)) {
        $delivery_charge_err = "Please enter delivery charge";
    } elseif (!ctype_digit($input_delivery_charge)) {
        $delivery_charge_err = "Please enter a delivery_charge";
    } else {
        $delivery_charge = $input_delivery_charge;
    }

    // Validate store_id
    $input_store_id = trim($_POST["store_id"]);
    if (empty($input_store_id)) {
        $store_id_err = "Please enter store_id";
    } elseif (!ctype_digit($input_store_id)) {
        $store_id_err = "Please enter a store_id";
    } else {
        $store_id = $input_store_id;
    }



    // Check input errors before inserting in database
    if (empty($order_id_err) && empty($serving_method_err) && empty($user_id_err) && empty($timedate_err) && empty($total_price_err) && empty($delivery_address_err) && empty($payment_method_err) && empty($transaction_id_err) && empty($product_id_err) && empty($quantity_err) && empty($subtotatl_err) && empty($delivery_charge_err) && empty($store_id_err)) {
        // Prepare an update statement
        $sql = "UPDATE orders SET order_id=?, serving_method=?,user_id=?,timedate=?, total_price=?,delivery_address=?,payment_method=?, transaction_id=?,product_id=?,quantity=?, subtotatl=?,delivery_charge=?,store_id=?  WHERE id=?";
        $stmt = mysqli_prepare($link, $sql);
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isisssssiissii", $param_order_id, $param_serving_method, $param_user_id, $param_timedate, $param_total_price, $param_delivery_address, $param_payment_method, $param_transaction_id, $param_product_id, $param_quantity, $param_subtotatl, $param_delivery_charge, $param_store_id, $param_id);

            // Set parameters
            $param_order_id = $order_id;
            $param_serving_method = $serving_method;
            $param_user_id = $user_id;
            $param_timedate = $timedate;
            $param_total_price = $total_price;
            $param_delivery_address = $delivery_address;
            $param_payment_method = $payment_method;
            $param_transaction_id = $transaction_id;
            $param_product_id = $product_id;
            $param_quantity = $quantity;
            $param_subtotatl = $subtotatl;
            $param_delivery_charge = $delivery_charge;
            $param_store_id = $store_id;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }


    }

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM orders WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

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
                    $natimedateme = $row["timedate"];
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
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }



        // Close connection
        mysqli_close($link);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Menu</title>
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
                    <h2 class="mt-5">Update Order</h2>
                    <p>Please edit the input values and submit to update the Order record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Order ID</label>
                            <input type="number" name="order_id"
                                class="form-control <?php echo (!empty($order_id_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $order_id; ?>">
                            <span class="invalid-feedback">
                                <?php echo $order_id_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Serving Method</label>
                            <input type="name" name="serving_method"
                                class="form-control <?php echo (!empty($serving_method_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $serving_method; ?>">
                            <span class="invalid-feedback">
                                <?php echo $serving_method_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>User ID</label>
                            <input type="number" name="user_id"
                                class="form-control <?php echo (!empty($user_id_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $user_id; ?>">
                            <span class="invalid-feedback">
                                <?php echo $user_id_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Time & date?</label>
                            <input type="datetime-local" name="timedate"
                                class="form-control <?php echo (!empty($timedate_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $timedate; ?>">
                            <span class="invalid-feedback">
                                <?php echo $timedate_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Total Price</label>
                            <input type="double" name="total_price"
                                class="form-control <?php echo (!empty($total_price_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $total_price; ?>">
                            <span class="invalid-feedback">
                                <?php echo $total_price_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Delivery Address</label>
                            <textarea name="delivery_address"
                                class="form-control <?php echo (!empty($delivery_address_err)) ? 'is-invalid' : ''; ?>"><?php echo $delivery_address; ?></textarea>
                            <span class="invalid-feedback">
                                <?php echo $delivery_address_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Payment Method</label>
                            <input type="name" name="payment_method"
                                class="form-control <?php echo (!empty($payment_method_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $payment_method; ?>">
                            <span class="invalid-feedback">
                                <?php echo $payment_method_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Transaction ID</label>
                            <input type="text" name="transaction_id"
                                class="form-control <?php echo (!empty($transaction_id_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $transaction_id; ?>">
                            <span class="invalid-feedback">
                                <?php echo $transaction_id_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Product ID</label>
                            <input type="number" name="product_id"
                                class="form-control <?php echo (!empty($product_id_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $product_id; ?>">
                            <span class="invalid-feedback">
                                <?php echo $product_id_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity"
                                class="form-control <?php echo (!empty($quantity_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $quantity; ?>">
                            <span class="invalid-feedback">
                                <?php echo $quantity_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Sub Total</label>
                            <input type="double" name="subtotatl"
                                class="form-control <?php echo (!empty($subtotatl_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $subtotatl; ?>">
                            <span class="invalid-feedback">
                                <?php echo $subtotatl_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Delivery Charge</label>
                            <input type="double" name="delivery_charge"
                                class="form-control <?php echo (!empty($delivery_charge_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $delivery_charge; ?>">
                            <span class="invalid-feedback">
                                <?php echo $delivery_charge_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Store ID</label>
                            <input type="number" name="store_id"
                                class="form-control <?php echo (!empty($store_id_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $store_id; ?>">
                            <span class="invalid-feedback">
                                <?php echo $store_id_err; ?>
                            </span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>