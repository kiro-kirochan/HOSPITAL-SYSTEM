<?php
require_once "includes/db.php";

$total_doctors      = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM doctb"))[0];
$total_patients     = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM patreg"))[0];
$total_appointments = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM appointmenttb"))[0];
$pending   = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM appointmenttb WHERE status='Pending'"))[0];
$confirmed = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM appointmenttb WHERE status='Confirmed'"))[0];
$completed = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM appointmenttb WHERE status='Completed'"))[0];
$cancelled = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM appointmenttb WHERE status='Cancelled'"))[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospitality - Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="profile-section">
        <div class="profile-avatar">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#8492a6" viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
        </div>
        <p class="profile-name">Administrator</p>
        <p class="profile-email">admin@hospitality.com</p>
        <a href="index.php" class="btn-logout">Log out</a>
    </div>
    <nav class="sidebar-nav">
        <a href="index.php" class="nav-item active">
            <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg></span>
            Dashboard
        </a>
        <a href="doctors/index.php" class="nav-item">
            <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.87-3.13-7-7-7zm2.85 11.1-.85.6V16h-4v-2.3l-.85-.6A4.997 4.997 0 0 1 7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 1.63-.79 3.16-2.15 4.1zM11 18h2v3h-2z"/></svg></span>
            Doctors
        </a>
        <a href="patients/index.php" class="nav-item">
            <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg></span>
            Patients
        </a>
        <a href="appointments/index.php" class="nav-item">
            <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg></span>
            Appointments
        </a>
    </nav>
</aside>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="topbar">
        <div class="topbar-search">
            <span class="topbar-search-icon"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg></span>
            <input type="text" placeholder="Search Doctor name or Record...">
        </div>
        <div class="topbar-date">
            <div class="date-label">Today's Date</div>
            <div class="date-value"><?php echo date('Y-m-d'); ?></div>
        </div>
        <button class="topbar-cal-btn">📅</button>
    </div>

    <div class="page-body">
        <div class="page-header">
            <div>
                <div class="page-title">Dashboard</div>
                <div class="page-subtitle">Welcome to the Hospital Management System</div>
            </div>
        </div>

        <!-- Status Label -->
        <p style="font-size:18px;font-weight:600;margin-bottom:12px;color:var(--text-dark);">Status</p>

        <!-- Stat Cards -->
        <div class="stats-row">
            <a href="doctors/index.php" class="stat-card">
                <div>
                    <div class="stat-number"><?php echo $total_doctors; ?></div>
                    <div class="stat-label">Doctors</div>
                </div>
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.87-3.13-7-7-7zm2.85 11.1-.85.6V16h-4v-2.3l-.85-.6A4.997 4.997 0 0 1 7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 1.63-.79 3.16-2.15 4.1zM11 18h2v3h-2z"/></svg>
                </div>
            </a>
            <a href="patients/index.php" class="stat-card">
                <div>
                    <div class="stat-number"><?php echo $total_patients; ?></div>
                    <div class="stat-label">Patients</div>
                </div>
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                </div>
            </a>
            <a href="appointments/index.php" class="stat-card">
                <div>
                    <div class="stat-number"><?php echo $total_appointments; ?></div>
                    <div class="stat-label">NewBooking</div>
                </div>
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 24 24"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>
                </div>
            </a>
            <a href="appointments/index.php" class="stat-card">
                <div>
                    <div class="stat-number"><?php echo $pending; ?></div>
                    <div class="stat-label">Today Sessions</div>
                </div>
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/></svg>
                </div>
            </a>
        </div>

        <!-- Upcoming Appointments Table -->
        <div style="display:flex;gap:20px;">
            <div style="flex:1;">
                <div class="section-title">Upcoming Appointments</div>
                <div class="section-subtitle">Here's a quick view of your appointment status breakdown.</div>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Confirmed</td><td><?php echo $confirmed; ?></td></tr>
                            <tr><td>Completed</td><td><?php echo $completed; ?></td></tr>
                            <tr><td>Cancelled</td><td><?php echo $cancelled; ?></td></tr>
                            <tr><td>Pending</td><td><?php echo $pending; ?></td></tr>
                        </tbody>
                    </table>
                </div>
                <a href="appointments/index.php" class="btn btn-primary" style="width:100%;justify-content:center;">Show all Appointments</a>
            </div>
            <div style="flex:1;">
                <div class="section-title">Quick Actions</div>
                <div class="section-subtitle">Manage your hospital records from here.</div>
                <div style="display:flex;flex-direction:column;gap:10px;margin-top:8px;">
                    <a href="appointments/create.php" class="btn btn-primary">+ New Appointment</a>
                    <a href="doctors/index.php" class="btn btn-soft">View All Doctors</a>
                    <a href="patients/index.php" class="btn btn-soft">View All Patients</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/main.js"></script>
</body>
</html>
