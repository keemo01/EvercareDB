<?php
// Function to establish a database connection
function connectDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "Blackboy1";
    $dbname = "hospital";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Function to authenticate user based on provided credentials
function authenticateUser($username, $password)
{
    $conn = connectDB();

    // Prepare a statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Verify the password using password_verify
        if (password_verify($password, $hashed_password)) {
            // Authentication successful, set session variables and redirect to the admin page
            session_start();
            $_SESSION['user_id'] = $user_id;
            header('Location: admin.php');
            exit();
        } else {
            // Authentication failed, redirect back to the login page with an error message
            header('Location: login.php?error=1');
            exit();
        }
    }

    // Authentication failed, redirect back to the login page with an error message
    header('Location: login.php?error=1');
    exit();
}


$stmt->close();
$conn->close();


// Process the login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Call the authentication function
        authenticateUser($username, $password);
    }
}
?>