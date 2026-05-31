<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospitality</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <!-- Profile Section -->
    <div class="profile-section">
        <div class="profile-avatar">
            <img src="/hospital/src/images/luhbobo.jpg" alt="Admin Profile">
        </div>
        <p class="profile-name">Administrator</p>
        <p class="profile-email">admin@hospitality.com</p>
        <a href="../index.php" class="btn-logout">Log out</a>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">
        <a href="../index.php" class="nav-item <?php echo (basename(dirname($_SERVER['PHP_SELF'])) === 'src' || basename($_SERVER['PHP_SELF']) === 'index.php' && basename(dirname($_SERVER['PHP_SELF'])) !== 'appointments' && basename(dirname($_SERVER['PHP_SELF'])) !== 'doctors' && basename(dirname($_SERVER['PHP_SELF'])) !== 'patients') ? 'active' : ''; ?>">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
            </span>
            Dashboard
        </a>
        <a href="../doctors/index.php" class="nav-item <?php echo (basename(dirname($_SERVER['PHP_SELF'])) === 'doctors') ? 'active' : ''; ?>">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.87-3.13-7-7-7zm2.85 11.1-.85.6V16h-4v-2.3l-.85-.6A4.997 4.997 0 0 1 7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 1.63-.79 3.16-2.15 4.1zM11 18h2v3h-2z"/></svg>
            </span>
            Doctors
        </a>
        <a href="../patients/index.php" class="nav-item <?php echo (basename(dirname($_SERVER['PHP_SELF'])) === 'patients') ? 'active' : ''; ?>">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
            </span>
            Patients
        </a>
        <a href="../appointments/index.php" class="nav-item <?php echo (basename(dirname($_SERVER['PHP_SELF'])) === 'appointments') ? 'active' : ''; ?>">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>
            </span>
            Appointments
        </a>
    </nav>
</aside>

<!-- MAIN CONTENT -->
<div class="main-content">

 

    <!-- PAGE BODY -->
    <div class="page-body">
