<!DOCTYPE html>
<html>

<head>
    <title>About Us</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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

        /* Sidebar styles */
        .sidebar {
            background-color: #000;
            margin-top: 60px;
            margin-bottom: 69px;
            color: #fff;
            padding: 20px;
            width: 183px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            text-decoration: underline;
        }

        .sidebar-content {
            background-color: #f8f9fa;
            padding: 20px;
            color: #333;
            margin-top: 20px;
        }
    </style>

</head>

<body>
    <!-- Include the navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/PPIT/Hospital/homepage/index.php">Evercare</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/PPIT/Hospital/homepage/about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PPIT/Hospital/Backend/register_patient.php">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PPIT/Hospital/Backend/register.php">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="sidebar">
                    <a href="/PPIT/Hospital/subheads/history.php">History</a>
                    <a href="/PPIT/Hospital/subheads/mission.php">Mission</a>
                    <a href="/PPIT/Hospital/subheads/commitment.php">Commitment Charter</a>
                    <a href="/PPIT/Hospital/subheads/board.php">Board and Executive Teams</a>
                    <a href="/PPIT/Hospital/subheads/professionalism.php">Professionalism in Healthcare</a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 mt-5 about-content">
                <h2>About Us</h2>
                <p>Welcome to Evercare Medical Centre, your premier destination for comprehensive healthcare. We are
                    dedicated
                    to providing outstanding medical services, delivering expert care, and improving the quality of life
                    for
                    our patients.</p>

                <p>Our state-of-the-art facilities are equipped with advanced medical technologies and staffed by a team
                    of
                    highly qualified professionals who are committed to your well-being. We offer a range of
                    specialties,
                    including cardiology, internal medicine, orthopedics, and more, ensuring that you receive
                    personalized care
                    tailored to your needs.</p>

                <p>At Evercare, we prioritize patient-centered care, focusing on holistic healing and individualized
                    treatment
                    plans. Whether you require preventive services, diagnostic tests, or advanced treatments, our
                    compassionate
                    team is here to guide you through every step of your healthcare journey.</p>

                <p>We are proud to serve our community and strive to foster a culture of trust, respect, and excellence
                    in
                    healthcare. Thank you for choosing Evercare Medical Centre as your trusted partner in wellness.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
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

    <!-- Add Bootstrap JS and jQuery script links -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>