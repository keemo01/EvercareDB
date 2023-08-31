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

// Query to fetch patients who have booked appointments
$query = "SELECT a.appointment_id, p.patient_id, p.full_name, p.email, a.date_time, d.name AS doctor_name
          FROM patient p
          INNER JOIN appointment a ON p.patient_id = a.patient_id
          INNER JOIN doctor d ON a.doctor_id = d.doctor_id
          ORDER BY a.date_time DESC";
$result = $conn->query($query);

// Check if the query executed successfully
if (!$result) {
    die("Error: " . $conn->error);
}

// Function to delete an appointment
function deleteAppointment($conn, $appointmentId)
{
    $sql = "DELETE FROM appointment WHERE appointment_id = $appointmentId";
    return $conn->query($sql);
}

// Function to update the booking time of an appointment
function updateAppointmentTime($conn, $appointmentId, $newDateTime)
{
    $sql = "UPDATE appointment SET date_time = '$newDateTime' WHERE appointment_id = $appointmentId";
    return $conn->query($sql);
}

// Check if the form is submitted for updating the appointment time
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["update_appointment"])) {
        $appointmentId = $_POST["appointment_id"];
        $newDateTime = $_POST["new_date_time"];
        updateAppointmentTime($conn, $appointmentId, $newDateTime);
    } elseif (isset($_POST["delete_appointment"])) {
        $appointmentId = $_POST["appointment_id"];
        deleteAppointment($conn, $appointmentId);
    }
}

function updateAppointmentStatus($conn)
{
    $currentTime = date('Y-m-d H:i:s');
    $oneHourLater = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // Update status to "Finished" for appointments that are past 1 hour from the current time
    $sql = "UPDATE appointment SET status = 'Finished' WHERE status = 'Ongoing' AND date_time < '$oneHourLater'";
    $conn->query($sql);

    // Update status to "Ongoing" for appointments that are within 1 hour from the current time
    $sql = "UPDATE appointment SET status = 'Ongoing' WHERE status = 'Scheduled' AND date_time >= '$currentTime' AND date_time < '$oneHourLater'";
    $conn->query($sql);
}

// Call the function to update appointment status
updateAppointmentStatus($conn);

?>

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
                        <a class="nav-link" href="invoices.php">Invoices</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Patients with Appointments</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Appointment Date</th>
                    <th>Doctor</th>
                    <th>Actions</th>
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
                        echo "<form class='d-inline' action='patient.php' method='post'>";
                        echo "<input type='hidden' name='appointment_id' value='" . $row["appointment_id"] . "'>";
                        echo "<input type='datetime-local' name='new_date_time' required>";
                        echo "<button type='submit' name='update_appointment' class='btn btn-success btn-sm mx-1'>Update</button>";
                        echo "</form>";
                        echo "<form class='d-inline' action='patient.php' method='post' onsubmit='return confirm(\"Are you sure you want to delete this appointment?\");'>";
                        echo "<input type='hidden' name='appointment_id' value='" . $row["appointment_id"] . "'>";
                        echo "<button type='submit' name='delete_appointment' class='btn btn-danger btn-sm'>Delete</button>";
                        echo "</form>";
                        echo "<form class='d-inline' action='view_patient.php' method='post'>";
                        echo "<input type='hidden' name='patient_id' value='" . $row["patient_id"] . "'>";
                        echo "<button type='submit' name='view_patient' class='btn btn-primary btn-sm mx-1'>View</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No patients with appointments found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JS from CDN (Optional, but required if you plan to use Bootstrap JavaScript components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>