<?php
session_start();

// Check if the user is already logged in, redirect to admin page
if (isset($_SESSION["user_id"])) {
    header("Location: admin.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Database connection (Replace with your database credentials)
    $host = "localhost";
    $usernameDB = "root";
    $passwordDB = "Blackboy1";
    $database = "hospital";

    // Create a database connection
    $conn = new mysqli($host, $usernameDB, $passwordDB, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user data from the 'users' table
    $sql = "SELECT user_id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verify the password
    if ($user && password_verify($password, $user["password"])) {
        // Password is correct, set session variables
        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["username"] = $user["username"];

        // Redirect to the admin page
        header("Location: admin.php");
        exit();
    } else {
        // Incorrect username or password
        $error_message = "Invalid username or password";
    }

    // Close the database connection
    $conn->close();
}
?>