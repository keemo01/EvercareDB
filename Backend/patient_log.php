<?php
session_start();

// Check if the user is already logged in, redirect to user page
if (isset($_SESSION["patient_user_id"])) {
    header("Location: /PPIT/Hospital/patient/userpage.php");
    exit();
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the provided username and password
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Replace the following with your actual database connection code
    $host = "localhost";
    $usernameDB = "root";
    $passwordDB = "Blackboy1";
    $database = "hospital";

    // Create a database connection
    $conn = mysqli_connect($host, $usernameDB, $passwordDB, $database);

    // Check if the connection was successful
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL statement to fetch the user based on the provided username
    $query = "SELECT user_id, username, password FROM patient_users WHERE username = ?";

    // Create a prepared statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameter (username) to the prepared statement
    mysqli_stmt_bind_param($stmt, "s", $username);

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);

    // Store the result
    mysqli_stmt_store_result($stmt);

    // Check if a row with the provided username exists
    if (mysqli_stmt_num_rows($stmt) == 1) {
        // Bind the result to variables
        mysqli_stmt_bind_result($stmt, $user_id, $db_username, $db_password);

        // Fetch the result (only one row expected)
        mysqli_stmt_fetch($stmt);

        // Verify the password
        if (password_verify($password, $db_password)) {
            // Password is correct, set the user ID in the session
            $_SESSION["patient_user_id"] = $user_id;

            // Redirect the user to the user page after successful login
            header("Location: /PPIT/Hospital/patient/userpage.php");
            exit();
        } else {
            // Invalid password, display an error message
            $login_error = "Invalid username or password.";
        }
    } else {
        // Invalid username, display an error message
        $login_error = "Invalid username or password.";
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Patient</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Set background image and properties */
        body {
            background-color: #f8f9fa;
            /* Set background color as fallback */
        }

        .navbar {
            /* Set the height of the navbar (you can adjust this value) */
            height: 60px;
        }

        .jumbotron {
            /* Set background image and size */
            background-image: url('images/doc.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            /* Set the height of the jumbotron to be twice the size of the navbar */
            height: calc(120px + 1rem);
            /* Consider the top and bottom padding (1rem) */
            /* Set the top margin to be equal to the height of the navbar */
            margin-top: 60px;
            /* Add padding to the jumbotron to adjust the text position */
            padding-top: 30px;
            padding-bottom: 30px;
        }

        /* Footer styles */
        .footer {
            background-color: #000;
            /* Black background color */
            color: #fff;
            /* White text color */
            padding: 20px;
            text-align: center;
            margin-top: 250px;
            /* Add margin at the top to separate it from the content */
        }

        .footer-columns {
            /* Set flexbox properties to create columns */
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
        }

        .footer-column {
            /* Set the width of each column */
            flex-basis: calc(33.33% - 30px);
            /* Adjust the width as needed */
            /* Add padding to each column */
            padding: 0 15px;
            margin-bottom: 20px;
            text-align: left;
        }

        /* Adjust spacing for the footer links */
        .footer-links {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/PPIT/Hospital/homepage/index.php">Evercare</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/PPIT/Hospital/homepage/about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PPIT/Hospital/Backend/register_patient.php">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PPIT/Hospital/Backend/register.php">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Patient Login</div>
                    <div class="card-body">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <?php if (isset($login_error)): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $login_error; ?>
                                </div>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>