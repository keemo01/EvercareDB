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

// Query to fetch patients with finished appointments for which invoices haven't been generated
$query = "SELECT a.appointment_id, p.patient_id, p.full_name, p.email, a.date_time, d.name AS doctor_name
          FROM patient p
          INNER JOIN appointment a ON p.patient_id = a.patient_id
          INNER JOIN doctor d ON a.doctor_id = d.doctor_id
          WHERE a.date_time <= NOW()
            AND a.appointment_id NOT IN (SELECT appointment_id FROM invoices)
          ORDER BY a.date_time DESC";
$result = $conn->query($query);

// Check if the query executed successfully
if (!$result) {
    die("Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Generate Invoices</title>
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
        <h2>Generate Invoices</h2>
        <form action="generate_invoice.php" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Appointment Date</th>
                        <th>Doctor</th>
                        <th>Generate Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["patient_id"] . "</td>";
                            echo "<td>" . $row["full_name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["date_time"] . "</td>";
                            echo "<td>" . $row["doctor_name"] . "</td>";
                            echo "<td>";
                            echo "<input type='radio' name='appointment_id' value='" . $row["appointment_id"] . "' required>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No finished appointments found for which invoices haven't been generated.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" name="generate_invoice" class="btn btn-primary">Generate Invoice</button>
        </form>
    </div>

    <!-- Add Bootstrap JS from CDN (Optional, but required if you plan to use Bootstrap JavaScript components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>