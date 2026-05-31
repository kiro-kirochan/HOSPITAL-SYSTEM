<?php
require_once "../includes/db.php";

$sql    = "SELECT * FROM patreg ORDER BY lname ASC, fname ASC";
$result = mysqli_query($conn, $sql);
?>

<?php require_once "../includes/header.php"; ?>

<div class="page-header">
    <div>
        <div class="page-title">Patients</div>
        <div class="page-subtitle">All registered patients</div>
    </div>
</div>

<div class="search-bar">
    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search patients...">
</div>

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Gender</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result) == 0) {
            echo "<tr><td colspan='5' style='text-align:center;padding:32px;color:#8492a6;'>No patients found.</td></tr>";
        } else {
            $counter = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $counter . "</td>";
                echo "<td style='font-weight:600;'>" . htmlspecialchars($row['fname'] . " " . $row['lname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
                echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                echo "</tr>";
                $counter++;
            }
        }
        ?>
        </tbody>
    </table>
</div>

<?php require_once "../includes/footer.php"; ?>
