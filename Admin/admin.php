<?php
session_start();

// Check if the user is already logged in, redirect to login page if not logged in
if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Rest of your admin panel code
?>


<!DOCTYPE html>
<html>

<head>
    <title>Admin Page</title>
    <!-- Add Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styling for the red navbar */
        .navbar-red {
            background-color: #ff0000;
            /* Red color */
        }
    </style>
</head>

<body>
    <!-- Red Navbar -->
    <nav class="navbar navbar-expand-lg navbar-red">
        <div class="container">
            <a class="navbar-brand" href="/PPIT/Hospital/Admin/admin.php">Admin Panel</a>
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
        <h2>Welcome to the Admin Page</h2>
        <p>Hello User ID
            <?php echo $_SESSION["user_id"]; ?>
        </p>
        <p>This is the admin page. You have successfully logged in!</p>
        <a href="/PPIT/Hospital/Backend/logout.php" class="btn btn-primary">Logout</a>
    </div>

    <!-- Add Bootstrap JS from CDN (Optional, but required if you plan to use Bootstrap JavaScript components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>