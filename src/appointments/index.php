<?php
require_once "../includes/db.php";

$message = "";
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == "created")  $message = "Appointment booked successfully!";
    if ($_GET['msg'] == "updated")  $message = "Appointment updated successfully!";
    if ($_GET['msg'] == "deleted")  $message = "Appointment deleted successfully!";
}

$sql = "SELECT
            appointmenttb.id,
            appointmenttb.apdate,
            appointmenttb.aptime,
            appointmenttb.reason,
            appointmenttb.status,
            patreg.fname AS patient_fname,
            patreg.lname AS patient_lname,
            doctb.name   AS doctor_name
        FROM appointmenttb
        LEFT JOIN patreg ON appointmenttb.pid = patreg.id
        LEFT JOIN doctb  ON appointmenttb.did = doctb.id
        ORDER BY appointmenttb.apdate DESC";

$result = mysqli_query($conn, $sql);
?>

<?php require_once "../includes/header.php"; ?>

<div class="page-header">
    <div>
        <div class="page-title">Appointments</div>
        <div class="page-subtitle">Book, view, update, and delete appointments</div>
    </div>
    <a href="create.php" class="btn btn-primary">+ New Appointment</a>
</div>

<?php if ($message != ""): ?>
    <div class="alert alert-success"><?php echo $message; ?></div>
<?php endif; ?>

<div class="search-bar">
    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search appointments...">
</div>

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Time</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result) == 0) {
            echo "<tr><td colspan='8' style='text-align:center;padding:32px;color:#8492a6;'>No appointments found. Click '+ New Appointment' to add one.</td></tr>";
        } else {
            $counter = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $counter . "</td>";
                echo "<td style='font-weight:600;'>" . htmlspecialchars($row['patient_fname'] . " " . $row['patient_lname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['doctor_name']) . "</td>";
                echo "<td>" . $row['apdate'] . "</td>";
                echo "<td>" . $row['aptime'] . "</td>";
                echo "<td>" . htmlspecialchars($row['reason']) . "</td>";
                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                echo "<td style='display:flex;gap:6px;'>";
                echo "<a href='edit.php?id=" . $row['id'] . "' class='btn btn-soft btn-sm'>✏ Edit</a>";
                echo "<button class='btn btn-danger-soft btn-sm' onclick='openConfirm(\"delete.php?id=" . $row['id'] . "\")'>🗑 Remove</button>";
                echo "</td>";
                echo "</tr>";
                $counter++;
            }
        }
        ?>
        </tbody>
    </table>
</div>

<?php require_once "../includes/footer.php"; ?>
