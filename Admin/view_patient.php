<!DOCTYPE html>
<html>

<head>
    <title>Patients with Appointments</title>
    <!-- Add Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <!-- Red Navbar -->
    <nav class="navbar navbar-expand-lg navbar-red">
        <div class="container">
            <a class="navbar-brand" href="admin.php">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="patient.php">Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stock.php">Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="invoice.php">Invoices</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>



<?php
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

// Check if the form is submitted for viewing the patient details
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["view_patient"])) {
    // Get the patient ID from the form submission
    $patientId = $_POST["patient_id"];

    // Fetch patient details from the database based on the patient ID
    $sql = "SELECT * FROM patient WHERE patient_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if patient exists in the database
    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
        // Display the patient's details in a user-friendly format
        echo "<h1>Patient Details</h1>";
        echo "<p><strong>Patient ID:</strong> " . $patient["patient_id"] . "</p>";
        echo "<p><strong>Full Name:</strong> " . $patient["full_name"] . "</p>";
        echo "<p><strong>Email:</strong> " . $patient["email"] . "</p>";
        echo "<p><strong>Created At:</strong> " . $patient["created_at"] . "</p>";
    } else {
        echo "<p>No patient found with the given ID.</p>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>