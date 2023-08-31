<?php
session_start();

// Check if the user is already logged in, redirect to admin panel
if (isset($_SESSION["user_id"])) {
    header("Location: /PPIT/Hospital/Admin/admin.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform your authentication here (e.g., check credentials against the database)

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

    // Get the provided username and password
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare the SQL statement to fetch the user based on the provided username
    $query = "SELECT user_id, username, password FROM users WHERE username = ?";

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
            $_SESSION["user_id"] = $user_id;

            // Redirect the user to the admin.php page after successful login
            header("Location: /PPIT/Hospital/Admin/admin.php");
            exit();
        } else {
            // Invalid password, display an error message
            $error_message = "Invalid username or password.";
        }
    } else {
        // Invalid username, display an error message
        $error_message = "Invalid username or password.";
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <!-- Add Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
        <h2>Admin Login</h2>
        <?php
        if (isset($error_message)) {
            echo "<p style='color: red;'>$error_message</p>";
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <input type="submit" class="btn btn-primary" value="Login">
        </form>

        <p>Click here if you haven't registered</p>
        <a href="register.php" class="btn btn-secondary">Register</a>
    </div>

    <!-- Add Bootstrap JS from CDN (Optional, but required if you plan to use Bootstrap JavaScript components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>