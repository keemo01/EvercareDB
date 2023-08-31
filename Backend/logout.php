<?php
// Start the session
session_start();

// Clear the session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page after logging out
header("Location: /PPIT/Hospital/Backend/login.php");
exit();
?>