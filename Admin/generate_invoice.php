<?php
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

if (isset($_POST['generate_invoice'])) {
    $appointment_id = $_POST['appointment_id'];

    // Query to get appointment details for generating invoice
    $query = "SELECT p.patient_id, p.full_name, p.email, a.date_time, d.name AS doctor_name
              FROM patient p
              INNER JOIN appointment a ON p.patient_id = a.patient_id
              INNER JOIN doctor d ON a.doctor_id = d.doctor_id
              WHERE a.appointment_id = ?";

    // Prepare the query using prepared statement
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $appointment_id);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if the query executed successfully
    if (!$result) {
        die("Error: " . $conn->error);
    }

    // Fetch appointment details
    $row = $result->fetch_assoc();
    $patient_id = $row["patient_id"];
    $patient_name = $row["full_name"];
    $patient_email = $row["email"];
    $appointment_date = $row["date_time"];
    $doctor_name = $row["doctor_name"];

    // Query to get the total cost for the appointment from the store table
    $cost_query = "SELECT SUM(price) AS total_cost
                   FROM store
                   WHERE item_id IN (SELECT item_id FROM appointment_items WHERE appointment_id = ?)";

    // Prepare the query using prepared statement
    $stmt = $conn->prepare($cost_query);
    $stmt->bind_param("i", $appointment_id);

    // Execute the query
    $stmt->execute();

    // Get the result
    $cost_result = $stmt->get_result();

    // Check if the query executed successfully
    if (!$cost_result) {
        die("Error: " . $conn->error);
    }

    // Fetch the total cost
    $cost_row = $cost_result->fetch_assoc();
    $total_cost = $cost_row["total_cost"];

    // Query to insert the generated invoice into the invoices table
    $insert_query = "INSERT INTO invoices (patient_id, appointment_id, cost, description)
                     VALUES (?, ?, ?, ?)";

    // Prepare the query using prepared statement
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("iids", $patient_id, $appointment_id, $total_cost, "Invoice for appointment with $doctor_name");

    // Execute the query
    $insert_result = $stmt->execute();

    // Check if the insertion was successful
    if (!$insert_result) {
        die("Error: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Invoice Generated</title>
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
                        <a class="nav-link" href="invoices.php">Invoices</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <?php if (isset($_POST['generate_invoice']) && $insert_result): ?>
            <h2>Invoice Generated Successfully</h2>
            <p><strong>Patient ID:</strong>
                <?php echo $patient_id; ?>
            </p>
            <p><strong>Patient Name:</strong>
                <?php echo $patient_name; ?>
            </p>
            <p><strong>Patient Email:</strong>
                <?php echo $patient_email; ?>
            </p>
            <p><strong>Appointment Date:</strong>
                <?php echo $appointment_date; ?>
            </p>
            <p><strong>Doctor:</strong>
                <?php echo $doctor_name; ?>
            </p>
            <p><strong>Total Cost:</strong> $
                <?php echo $total_cost; ?>
            </p>
        <?php else: ?>
            <h2>Invoice Generation Failed</h2>
        <?php endif; ?>
        <a href="invoices.php" class="btn btn-primary">Back to Invoices</a>
    </div>

    <!-- Add Bootstrap JS from CDN (Optional, but required if you plan to use Bootstrap JavaScript components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>