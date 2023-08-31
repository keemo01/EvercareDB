<!DOCTYPE html>
<html>

<head>
    <title>History - Evercare Medical Centre</title>
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
                <h2>History of Evercare Medical Centre</h2>
                <p>Evercare Medical Centre, a beacon of healthcare excellence, traces its origins back to a visionary's
                    dream and a profound commitment to community well-being. Founded in the heart of bustling New York
                    City in 1985 by Dr. Emily Thompson, the hospital emerged as a response to the growing need for
                    comprehensive and patient-centered medical care.</p>

                <p>Dr. Thompson, a respected physician with a deep passion for healing, recognized the limitations of
                    existing healthcare facilities and was determined to create a haven where patients would receive not
                    only expert medical treatment but also compassionate support. With an unwavering dedication to
                    raising the bar in healthcare, she gathered a team of like-minded professionals who shared her
                    values and enthusiasm.</p>

                <p>The journey was not without challenges, but Dr. Thompson's perseverance and the team's collective
                    spirit propelled Evercare's growth. From its modest beginnings, the hospital expanded its services,
                    incorporating cutting-edge technologies and a diverse range of medical specialties. Evercare's
                    reputation for excellence spread, and it became a trusted destination for patients seeking top-tier
                    medical care.</p>

                <p>Throughout the years, Evercare reached several significant milestones that shaped its identity as a
                    leading healthcare institution. In the early 1990s, the hospital introduced a groundbreaking
                    telemedicine program, connecting patients in remote areas with expert physicians, and setting a new
                    standard for accessible care.</p>

                <p>As the hospital continued to thrive, Dr. Thompson's vision extended beyond providing medical
                    treatment. She established the Evercare Foundation, a non-profit organization dedicated to funding
                    medical research, community health initiatives, and scholarships for aspiring healthcare
                    professionals.</p>

                <p>Evercare's commitment to the community extended beyond its walls, with numerous outreach programs and
                    partnerships aimed at enhancing public health awareness and access to quality care. The hospital
                    played a vital role in disaster relief efforts during the aftermath of Hurricane Sandy, providing
                    essential medical services to those in need.</p>

                <p>Today, Evercare Medical Centre stands as a testament to Dr. Thompson's visionary leadership and the
                    collective efforts of a passionate healthcare community. The hospital remains committed to its
                    founding principles of excellence, compassion, and innovation, continuously striving to elevate the
                    standards of healthcare delivery and positively impact the lives of countless individuals.</p>
            </div>

        </div>
    </div>

    <!-- Footer -->
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