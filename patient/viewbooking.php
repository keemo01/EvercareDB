<?php
session_start();

// Check if the user is not logged in or not a patient, redirect to the login page or appropriate page
if (!isset($_SESSION["patient_user_id"])) {
    header("Location: patient_log.php");
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

// Function to fetch patient's appointments
function fetchAppointments($conn, $patientId)
{
    $sql = "SELECT a.appointment_id, d.name AS doctor_name, a.date_time, a.description FROM appointment a INNER JOIN doctor d ON a.doctor_id = d.doctor_id WHERE a.patient_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Get the user ID from the session
$patientId = $_SESSION['patient_user_id'];

// Fetch the patient's appointments
$appointments = fetchAppointments($conn, $patientId);

// Close the connection
$conn->close();

// Handle appointment cancellation
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cancel_appointment"])) {
    // Reconnect to the database
    $conn = new mysqli($host, $usernameDB, $passwordDB, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $appointmentId = $_POST["appointment_id"];

    // Perform the cancellation logic here, e.g., delete the appointment from the database
    $sql = "DELETE FROM appointment WHERE appointment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $appointmentId);

    if ($stmt->execute()) {
        // Refresh the page after cancellation to update the list of appointments
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Appointments</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
</head>

<body>
    <!-- Navbar code goes here -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/PPIT/Hospital/patient/userpage.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/PPIT/Hospital/patient/bookapp.php">Book Appointment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PPIT/Hospital/patient/paitents.php">Patient Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PPIT/Hospital/patient/form.html">Request Form</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PPIT/Hospital/patient/viewbooking.php">View Bookings</a>
                    </li>
                </ul>
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="btn btn-danger" href="/PPIT/Hospital/Backend/logout.php"> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <h2>Your Appointments</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Doctor Name</th>
                    <th>Date and Time</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td>
                            <?= $appointment['doctor_name'] ?>
                        </td>
                        <td>
                            <?= $appointment['date_time'] ?>
                        </td>
                        <td>
                            <?= $appointment['description'] ?>
                        </td>
                        <td>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <input type="hidden" name="appointment_id" value="<?= $appointment['appointment_id'] ?>">
                                <button type="submit" class="btn btn-danger" name="cancel_appointment">Cancel</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer code goes here -->
    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>