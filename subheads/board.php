<!DOCTYPE html>
<html>

<head>
    <title>Board and Executive Teams - Evercare Medical Centre</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add your custom CSS styles here -->
    <style>
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

        /* Grid styles */
        .doctor-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px;
        }

        .doctor-card {
            border: 1px solid #ccc;
            padding: 20px;
            text-align: center;
        }


        .doctor-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
            /* Add the following styles to adjust image size */
            width: 200px;
            /* Set the desired width */
            height: 200px;
            /* Set the desired height */
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
            <!--Sidebar-->
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
                <h2>Board and Executive Teams of Evercare Medical Centre</h2>
                <p>The leadership of Evercare Medical Centre is comprised of dedicated professionals who bring diverse
                    expertise and a shared commitment to advancing healthcare excellence.</p>

                <div class="doctor-grid">
                    <!-- Doctor Card 1 -->
                    <div class="doctor-card">
                        <img src="../images/doctor1.jpg" alt="Dr. Jane Smith" class="doctor-image">
                        <h4>Dr. Jane Smith</h4>
                        <p>Chief Medical Officer</p>
                    </div>

                    <!-- Doctor Card 2 -->
                    <div class="doctor-card">
                        <img src="../images/doctor3.jpg" alt="Dr. John Doe" class="doctor-image">
                        <h4>Dr. John Doe</h4>
                        <p>Chief Executive Officer</p>
                    </div>

                    <!-- Doctor Card 3 -->
                    <div class="doctor-card">
                        <img src="../images/doctor2.jpg" alt="Dr. Emily Johnson" class="doctor-image">
                        <h4>Dr. Emily Johnson</h4>
                        <p>Chief Operating Officer</p>
                    </div>

                    <!-- Doctor Card 4 -->
                    <div class="doctor-card">
                        <img src="images/doctor4.jpg" alt="Dr. Michael Williams" class="doctor-image">
                        <h4>Dr. Michael Williams</h4>
                        <p>Chief Financial Officer</p>
                    </div>
                </div>
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