<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$featured_product_id = $name = $product_id = "";
$featured_product_id_err = $name_err = $product_id_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    // Validate featured product id
    $input_featured_product_id = trim($_POST["featured_product_id"]);
    if (empty($input_featured_product_id)) {
        $featured_product_id_err = "Please enter featured product id";
    } elseif (!ctype_digit($input_featured_product_id)) {
        $featured_product_id_err = "Please enter a featured product id";
    } else {
        $featured_product_id = $input_featured_product_id;
    }


    // Validate product id
    $input_product_id = trim($_POST["product_id"]);
    if (empty($input_product_id)) {
        $product_id_err = "Please enter product id;";
    } else {
        $product_id = $input_product_id;
    }

    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name";
    } else {
        $name = $input_name;
    }


    // Check input errors before inserting in database
    if (empty($name_err) && empty($featured_product_id_err) && empty($product_id_err)) {
        // Prepare an update statement
        $sql = "UPDATE featured_products SET featured_product_id=?, product_id=?, name=? WHERE id=?";
        $stmt = mysqli_prepare($link, $sql);
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "issi", $param_featured_product_id, $param_product_id, $param_name, $param_id);

            // Set parameters
            $param_featured_product_id = $featured_product_id;
            $param_product_id = $product_id;
            $param_name = $name;
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
        $sql = "SELECT * FROM featured_products WHERE id = ?";
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
                    $featured_product_id = $row["featured_product_id"];
                    $product_id = $row["product_id"];
                    $name = $row["name"];
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
    <title>Update Featured Product</title>
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
                    <h2 class="mt-5">Update Featured Product</h2>
                    <p>Please edit the input values and submit to update the store record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Featured Product ID</label>
                            <input type="number" name="featured_product_id"
                                class="form-control <?php echo (!empty($featured_product_id_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $featured_product_id; ?>">
                            <span class="invalid-feedback">
                                <?php echo $featured_product_id_err; ?>
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
                            <label>Featured Product Name</label>
                            <input type="name" name="name"
                                class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $name; ?>">
                            <span class="invalid-feedback">
                                <?php echo $name_err; ?>
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