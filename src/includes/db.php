<?php
// ============================================================
// db.php — Database Connection File
// ============================================================
// This file connects PHP to our MySQL database.
// We include this file in every page that needs the database.
// ============================================================

// These are the settings to connect to MySQL.
// If you use XAMPP, these default values usually work as-is.
$host     = "localhost";    // Where MySQL is running
$user     = "root";         // MySQL username (default in XAMPP: root)
$password = "";             // MySQL password (default in XAMPP: empty)
$database = "hospital";     // The name of our database

// mysqli_connect() opens the connection to MySQL.
// It needs: host, username, password, and database name.
$conn = mysqli_connect($host, $user, $password, $database);

// Check if the connection worked.
// If not, stop everything and show the error.
if (!$conn) {
    die("Cannot connect to database: " . mysqli_connect_error());
}
// If we get here, the connection is working!
?>
