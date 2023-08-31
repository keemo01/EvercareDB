<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Hash the password for security (You can use a more secure hashing method)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Database connection
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

    // Check if the username or email already exists in the database
    $query_username = "SELECT username FROM users WHERE username = ?";
    $stmt_username = $conn->prepare($query_username);
    $stmt_username->bind_param("s", $username);
    $stmt_username->execute();
    $result_username = $stmt_username->get_result();

    $query_email = "SELECT email FROM users WHERE email = ?";
    $stmt_email = $conn->prepare($query_email);
    $stmt_email->bind_param("s", $email);
    $stmt_email->execute();
    $result_email = $stmt_email->get_result();

    if ($result_username->num_rows > 0) {
        // Username already exists, show an error message
        echo "Error: Username already exists. Please choose a different username.";
    } elseif ($result_email->num_rows > 0) {
        // Email already exists, show an error message
        echo "Error: Email already exists. Please use a different email address.";
    } else {
        // Insert user data into the 'users' table
        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($sql);
        $stmt_insert->bind_param("sss", $username, $hashedPassword, $email);

        if ($stmt_insert->execute()) {
            // Registration successful, redirect to login page
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>