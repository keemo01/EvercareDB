<!DOCTYPE html>
<html>

<head>
    <title>Hospital Management System</title>
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
            background-image: url('../images/doc.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            /* Set the height of the jumbotron to be twice the size of the navbar */
            height: 70vh;
            /* Set to full viewport height */
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

        .info-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            background-color: lightblue;
            gap: 20px;
            margin-top: 40px;
        }

        .info-item {
            text-align: center;
        }

        /* Added style for career section */
        .career-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 50px auto;
            padding: 0 20px;
            max-width: 1200px;
        }

        .career-text {
            flex: 1;
            padding-right: 20px;
        }

        .career-image {
            flex: 1;
            text-align: right;
        }

        /* Style for the news grid */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 40px;
        }

        .news-item {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            text-align: center;
        }

        .news-item:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
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

    <!-- Main Content -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">Welcome to Evercare</h1>
            <p class="lead">This is a simple hospital management system homepage.</p>
            <hr class="my-4">
            <p>Explore our services and register online.</p>
            <a class="btn btn-primary btn-lg" href="/PPIT/Hospital/Backend/register_patient.php" role="button">Get
                Started</a>
        </div>
    </div>

    <!-- Information Grid -->
    <div class="container">
        <p> IRELAND'S LARGEST INDEPENDENT HOSPITAL GROUP </p>
        <div class="info-grid">
            <div class="info-item">
                <h2>&gt; 300,000</h2>
                <p>Patients</p>
            </div>
            <div class="info-item">
                <h2>5</h2>
                <p>JCI Accreditations</p>
            </div>
            <div class="info-item">
                <h2>&gt; 490</h2>
                <p>Consultants</p>
            </div>
            <div class="info-item">
                <h2>&gt; 3,000</h2>
                <p>Employees</p>
            </div>
        </div>
    </div>

    <!-- Career Section -->
    <div class="container">
        <div class="career-section">
            <div class="career-text">
                <h2>Build Your Career with Us</h2>
                <p>You bring the right skills and values and we provide the opportunity for you to grow your career in
                    an environment where dignity and respect is paramount.</p>
                <br>
                <a href="career.php"> Visit Careers</a>
            </div>
            <div class="career-image">
                <img src="../images/career.jpg" alt="Build Your Career" style="max-width: 100%;">
            </div>
        </div>
    </div>

    <!-- News Section -->
    <div class="container">
        <div class="news-grid" id="newsGrid">
            <!-- News items will be added here dynamically -->
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

    <!-- Add Bootstrap JS and jQuery script links -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Function to fetch medical news from NewsAPI
        async function fetchNews() {
            const apiKey = '7e07333e33234db8ac28e319fd52cdd4';
            const apiUrl = `https://newsapi.org/v2/top-headlines?country=us&category=health&apiKey=${apiKey}`;

            try {
                const response = await fetch(apiUrl);
                const data = await response.json();
                const newsItems = document.getElementById('newsGrid');
                newsItems.innerHTML = ''; // Clear previous news
                data.articles.forEach((article, index) => {
                    if (index >= 4) return; // Display only 4 latest news items
                    const newsItem = createNewsItem(article.title, article.description);
                    newsItems.appendChild(newsItem);
                });
            } catch (error) {
                console.error('Error fetching news:', error);
            }
        }

        // Function to create a news item element
        function createNewsItem(title, description) {
            const newsItem = document.createElement('div');
            newsItem.className = 'news-item';
            newsItem.innerHTML = `
                <h3>${title}</h3>
                <p>${description}</p>
            `;
            return newsItem;
        }

        // Fetch news on page load
        fetchNews();

        // Update news every hour
        setInterval(fetchNews, 3600000); // 1 hour in milliseconds
    </script>
</body>

</html>