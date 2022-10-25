<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$title = $image_url = $redirect_url = $category_id = "";
$title_err = $image_url_err = $redirect_url_err = $category_id_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate title
    $input_title = trim($_POST["title"]);
    if (empty($input_title)) {
        $title_err = "Please enter a Title";
    } else {
        $title = $input_title;
    }

    // Validate image URL
    $input_image_url = trim($_POST["image_url"]);
    if (empty($input_image_url)) {
        $image_url_err = "Please enter an image url;";
        // } elseif(!filter_var($input_branch_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$+[1-20]/")))){
        //     $branch_name_err = "Please enter a valid store name";
        // } 
    } else {
        $image_url = $input_image_url;
    }
    // Validate redirect Url
    $input_redirect_url = trim($_POST["redirect_url"]);
    if (empty($input_redirect_url)) {
        $redirect_url_err = "Please enter a redirect url";
    } else {
        $redirect_url = $input_redirect_url;
    }

    // Validate phone
    $input_category_id = trim($_POST["category_id"]);
    if (empty($input_category_id)) {
        $category_id_err = "Please enter category id for banner";
    } elseif (!ctype_digit($input_category_id)) {
        $category_id_err = "Please enter a valid category id";
    } else {
        $category_id = $input_category_id;
    }


    // Check input errors before inserting in database
    if (empty($title_err) && empty($image_url_err) && empty($redirect_url_err) && empty($category_id_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO banner_ad (title, image_url, redirect_url, category_id) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_title, $param_image_url, $param_redirect_url, $param_category_id);

            // Set parameters
            $param_title = $title;
            $param_image_url = $image_url;
            $param_redirect_url = $redirect_url;
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
    <title>Create Banner AD</title>
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
                    <h2 class="mt-5">Create Banner Ad</h2>
                    <p>Please fill this form and submit to add Banner AD to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Banner Title</label>
                            <input type="text" name="title"
                                class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $title; ?>">
                            <span class="invalid-feedback">
                                <?php echo $title_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Image URL</label>
                            <input type="url" name="image_url"
                                class="form-control <?php echo (!empty($image_url_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $image_url; ?>">
                            <span class="invalid-feedback">
                                <?php echo $image_url_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Redirect URL</label>
                            <input type="url" name="redirect_url"
                                class="form-control <?php echo (!empty($redirect_url_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $redirect_url; ?>">
                            <span class="invalid-feedback">
                                <?php echo $redirect_url_err; ?>
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
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>