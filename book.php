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
    } elseif (isset($_POST["book_appointment"])) {
        // Process the appointment booking
        $doctorId = $_POST["doctor_id"];
        $appointmentDateTime = $_POST["date_time"];
        $description = $_POST["description"];
        $fullName = $_POST["full_name"];

        // Check if the patient already exists in the database
        $sql = "SELECT patient_id FROM patient WHERE full_name = '$fullName'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Patient already exists, get the patient ID from the database
            $row = $result->fetch_assoc();
            $patientId = $row["patient_id"];
        } else {
            // Patient does not exist, insert a new patient record into the database
            $sql = "INSERT INTO patient (email, full_name, created_at) VALUES ('$fullName@example.com', '$fullName', CURRENT_TIMESTAMP)";

            if ($conn->query($sql) === TRUE) {
                // Get the newly generated patient ID
                $patientId = $conn->insert_id;
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
                $conn->close();
                exit; // Exit the script if there's an error
            }
        }

        // Check if the selected appointment slot is available
        $sql = "SELECT date_time FROM appointment WHERE doctor_id = '$doctorId' AND date_time = '$appointmentDateTime'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='alert alert-danger mt-3'>This time slot is already taken. Please choose another time.</div>";
        } else {
            // Insert data into the appointment table with the patient ID
            $sql = "INSERT INTO appointment (doctor_id, date_time, description, patient_id) VALUES ('$doctorId', '$appointmentDateTime', '$description', '$patientId')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success mt-3'>Appointment booked successfully for patient $fullName (Patient ID: $patientId)!</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
            }
        }
    }
}

// Fetch available appointment slots for each doctor
$doctorSlots = array();
$sql = "SELECT doctor_id FROM doctor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $doctorId = $row["doctor_id"];
        $doctorSlots[$doctorId] = array();
        $startTime = strtotime('09:00:00');
        $endTime = strtotime('17:00:00');

        while ($startTime < $endTime) {
            // Check if the slot is available (not booked by another patient)
            $available = true;
            $dateTime = date("Y-m-d H:i:s", $startTime);
            $sql = "SELECT * FROM appointment WHERE doctor_id = '$doctorId' AND date_time = '$dateTime'";
            $slotResult = $conn->query($sql);

            if ($slotResult->num_rows > 0) {
                $available = false;
            }

            // Check if there is at least 30 minutes between each booking
            if (count($doctorSlots[$doctorId]) > 0) {
                $lastSlotTime = end($doctorSlots[$doctorId]);
                $timeDiff = strtotime($dateTime) - strtotime($lastSlotTime);

                if ($timeDiff < 1800) {
                    $available = false;
                }
            }

            // Add the slot to the list if available
            if ($available) {
                $doctorSlots[$doctorId][] = $dateTime;
            }

            // Move to the next 30-minute interval
            $startTime += 1800;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hospital Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">

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

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Evercare</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="book.php">Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="form.html">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register_patient.php">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <h1 class="display-4">Welcome to the Hospital Management System</h1>

        <h1 class="display-4">Appointments</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label for="doctor_id">Doctor</label>
                <select class="form-control" id="doctor_id" name="doctor_id" required>
                    <?php
                    // Connects to the database
                    $servername = "localhost";
                    $username = "root";
                    $password = "Blackboy1";
                    $dbname = "hospital";
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Checks the connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch the existing doctors from the database
                    $sql = "SELECT doctor_id, name FROM doctor";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["doctor_id"] . "'>" . $row["name"] . "</option>";
                        }
                    } else {
                        echo "<option disabled>No doctors available</option>";
                    }

                    $conn->close();
                    ?>
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

        <?php
        if (isset($_POST["book_appointment"])) {
            $servername = "localhost";
            $username = "root";
            $password = "Blackboy1";
            $dbname = "hospital";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get data from the form
            $doctor_id = $_POST["doctor_id"];
            $date_time = $_POST["date_time"];
            $description = $_POST["description"];
            $full_name = $_POST["full_name"]; // New patient full name
        
            // Check if the patient already exists in the database
            $sql = "SELECT patient_id FROM patient WHERE full_name = '$full_name'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Patient already exists, get the patient ID from the database
                $row = $result->fetch_assoc();
                $patient_id = $row["patient_id"];
            } else {
                // Patient does not exist, insert a new patient record into the database
                $sql = "INSERT INTO patient (email, full_name, created_at) VALUES ('$full_name@example.com', '$full_name', CURRENT_TIMESTAMP)";

                if ($conn->query($sql) === TRUE) {
                    // Get the newly generated patient ID
                    $patient_id = $conn->insert_id;
                } else {
                    echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
                    $conn->close();
                    exit; // Exit the script if there's an error
                }
            }

            // Insert data into the appointment table with the patient ID
            $sql = "INSERT INTO appointment (doctor_id, date_time, description, patient_id) VALUES ('$doctor_id', '$date_time', '$description', '$patient_id')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success mt-3'>Appointment booked successfully for patient $full_name (Patient ID: $patient_id)!</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
            }

            $conn->close();
        }
        ?>
    </div>

    <footer class="footer">
        <div class="container footer-columns">
            <!-- Our Address -->
            <div class="footer-column">
                <p>Our address</p>
                <p>Evercare Medical Centre</p>
                <p>42 Elm Street, New York</p>
                <p>Phone No.: 123-456-7890</p>
                <p>Fax No.: 987-654-3210</p>
                <p>E-Mail: info@evercaremedical.com</p>
            </div>

            <!-- Opening Hours -->
            <div class="footer-column">
                <p>Opening Hours</p>
                <p>Mon – Fri:</p>
                <p>9:00AM - 5:00PM</p>
                <p>Sat*:</p>
                <p>10:00AM - 2:00PM</p>
                <p>Sun*:</p>
                <p>Closed</p>
                <p>Bank Holidays:</p>
                <p>Closed</p>
                <p>* Appointment Required, Email for Appointment</p>
            </div>

            <!-- Useful Links -->
            <div class="footer-column">
                <p>Useful Links</p>
                <div class="footer-links">
                    <p>General Information</p>
                    <p>Patient Support Organizations</p>
                    <p>Hospitals</p>
                    <p>Health Insurance Providers</p>
                </div>
                <div class="footer-links">
                    <p>Policy</p>
                    <p>Practice Policy</p>
                    <p>Privacy Policy</p>
                    <p>Cookie Policy</p>
                </div>
            </div>
        </div>

        <p>&copy; 2023 Evercare Medical Centre. Designed by VandelayDesign.com. All rights reserved.</p>
    </footer>

</body>

</html>