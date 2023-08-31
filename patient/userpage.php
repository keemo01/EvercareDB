<?php
// Start the session to access user data from the login process
session_start();

// Check if the user is NOT logged in, redirect to login page
if (!isset($_SESSION["patient_user_id"])) {
    header("Location: patient_log.php");
    exit();
}


// Get the user ID from the session
$user_id = $_SESSION['patient_user_id'];

?>


<!DOCTYPE html>
<html>

<head>
    <title>User Page</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        /* Your custom styles go here */
    </style>

</head>

<body>
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

    <div class="container mt-4">
        <h2>Welcome,
            <?php echo $user_id; ?>!
        </h2>
        <p>Hello,
            <?php echo $user_id; ?>. Welcome to your personalized user page.
        </p>
        <!-- Add more content specific to the user here -->
    </div>

    <!-- Footer -->
    <footer class="footer">
        <!-- Your footer code goes here -->
    </footer>

    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>