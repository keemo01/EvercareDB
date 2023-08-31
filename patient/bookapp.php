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

// Function to book an appointment
function bookAppointment($conn, $doctorId, $appointmentDateTime, $description, $fullName)
{
    // Check if the selected appointment slot is available
    $sql = "SELECT date_time FROM appointment WHERE doctor_id = ? AND date_time = ?";
    $stmt = $conn->prepare($sql);

    // Convert the appointment date and time to the correct format
    $appointmentDateTime = date("Y-m-d H:i:s", strtotime($appointmentDateTime));

    $stmt->bind_param("ss", $doctorId, $appointmentDateTime);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='alert alert-danger mt-3'>This time slot is already taken. Please choose another time.</div>";
    } else {
        // Check if the patient already exists in the database
        $sql = "SELECT patient_id FROM patient WHERE full_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $fullName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Patient already exists, get the patient ID from the database
            $row = $result->fetch_assoc();
            $patientId = $row["patient_id"];
        } else {
            // Patient does not exist, insert a new patient record into the database
            $email = $fullName . "@example.com";
            $sql = "INSERT INTO patient (email, full_name, created_at) VALUES (?, ?, CURRENT_TIMESTAMP)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $fullName);
            if ($stmt->execute()) {
                // Get the newly generated patient ID
                $patientId = $stmt->insert_id;
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
                return;
            }
        }

        // Insert data into the appointment table with the patient ID
        $sql = "INSERT INTO appointment (doctor_id, date_time, description, patient_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $doctorId, $appointmentDateTime, $description, $patientId);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success mt-3'>Appointment booked successfully for patient $fullName (Patient ID: $patientId)!</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
        }
    }
}

// Fetch the existing doctors from the database
$sql = "SELECT doctor_id, name FROM doctor";
$result = $conn->query($sql);
$doctors = $result->fetch_all(MYSQLI_ASSOC);

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hospital Management System</title>
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
        <h1 class="display-4">Welcome to Evercare</h1>

        <h1 class="display-4">Appointments</h1>
        <form action="viewbooking.php" method="POST">
            <div class="form-group">
                <label for="doctor_id">Doctor</label>
                <select class="form-control" id="doctor_id" name="doctor_id" required>
                    <?php foreach ($doctors as $doctor): ?>
                        <option value="<?php echo $doctor['doctor_id']; ?>"><?php echo $doctor['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="date_time">Appointment Date and Time</label>
                <input type="datetime-local" class="form-control" id="date_time" name="date_time" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="full_name">Patient Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <button type="submit" class="btn btn-primary" name="book_appointment">Book Appointment</button>
        </form>
    </div>
</body>

</html>

<?php
// Check if the form is submitted for booking the appointment
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["book_appointment"])) {
    // Database connection
    $conn = new mysqli($host, $usernameDB, $passwordDB, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from the form
    $doctorId = $_POST["doctor_id"];
    $appointmentDateTime = $_POST["date_time"];
    $description = $_POST["description"];
    $fullName = $_POST["full_name"];

    // Call the function to book the appointment
    bookAppointment($conn, $doctorId, $appointmentDateTime, $description, $fullName);

    // Close the connection
    $conn->close();
}
?>