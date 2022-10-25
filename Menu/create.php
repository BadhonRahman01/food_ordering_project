<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$featured_product_id = $name = $category_id = "";
$featured_product_id_err = $name_err = $category_id_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
    $input_category_id = trim($_POST["category_id"]);
    if (empty($input_category_id)) {
        $category_id_err = "Please enter product id;";
    } else {
        $category_id = $input_category_id;
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
    if (empty($name_err) && empty($featured_product_id_err) && empty($category_id_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO menus (name,category_id,featured_product_id) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sii", $param_name, $param_category_id, $param_featured_product_id);

            // Set parameters
            $param_featured_product_id = $featured_product_id;
            $param_name = $name;
            $param_category_id = $category_id;


            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page

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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Menu</title>
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
                    <h2 class="mt-5">Create Menu</h2>
                    <p>Please fill this form and submit to add Menu to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Menu Name</label>
                            <input type="name" name="name"
                                class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $name; ?>">
                            <span class="invalid-feedback">
                                <?php echo $name_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Category ID</label>
                            <input type="number" name="category_id"
                                class="form-control <?php echo (!empty($category_id_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $category_id; ?>">
                            <span class="invalid-feedback">
                                <?php echo $category_id_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Featured Product ID</label>
                            <input type="number" name="featured_product_id"
                                class="form-control <?php echo (!empty($featured_product_id_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $featured_product_id; ?>">
                            <span class="invalid-feedback">
                                <?php echo $featured_product_id_err; ?>
                            </span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>