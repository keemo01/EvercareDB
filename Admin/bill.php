<?php
session_start();

// Check if the user is not logged in or not a patient, redirect to the login page or appropriate page
if (!isset($_SESSION["patient_user_id"])) {
    header("Location: login_patient.php");
    exit();
}

// Database connection details
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

// Function to fetch the user's bill// Function to fetch the user's bill
function getUserBill($conn, $patientId)
{
    $sql = "SELECT * FROM bill WHERE patient_id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "<div class='alert alert-danger mt-3'>Error in preparing statement: " . $conn->error . "</div>";
        return null;
    }

    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return null;
}


// Fetch the user's bill
$patientId = $_SESSION["patient_user_id"];
$bill = getUserBill($conn, $patientId);

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hospital Management System - Invoice</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">

    <!-- Your custom styles go here -->
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
    <!-- ... (your existing body content) ... -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="userpage.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="bookapp.php">Book Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bill.php">My Bill</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Patient Dashboard</a>
                    </li>
                </ul>
                <li class="nav-item">
                    <a class="btn btn-danger" href="logout.php">Logout</a>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <h1 class="display-4">Hospital Invoice</h1>
        <?php if ($bill): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Invoice Details</h5>
                    <p><strong>Invoice ID:</strong>
                        <?php echo $bill['bill_id']; ?>
                    </p>
                    <p><strong>Patient Name:</strong>
                        <?php echo $bill['patient_name']; ?>
                    </p>
                    <p><strong>Amount Due:</strong> $
                        <?php echo $bill['amount']; ?>
                    </p>
                    <!-- Add other invoice details here -->

                    <h5 class="card-title mt-4">Payment Options</h5>
                    <p>Select your preferred payment method:</p>
                    <form action="#" method="post">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="credit_card"
                                value="credit_card">
                            <label class="form-check-label" for="credit_card">
                                Credit Card
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal">
                            <label class="form-check-label" for="paypal">
                                PayPal
                            </label>
                        </div>
                        <!-- Add other payment methods as needed -->
                        <button type="submit" class="btn btn-primary mt-3" name="submit_payment">Submit Payment</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <p>No invoice found for this patient.</p>
        <?php endif; ?>
    </div>
    <!-- ... (your existing footer content) ... -->
</body>

</html>