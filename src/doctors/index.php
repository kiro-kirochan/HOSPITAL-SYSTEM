<?php
require_once "../includes/db.php";

$sql    = "SELECT doctb.id, doctb.name, doctb.email, doctb.docFees,
                  specialtb.specialization
           FROM doctb
           LEFT JOIN specialtb ON doctb.spec_id = specialtb.id
           ORDER BY doctb.name ASC";
$result = mysqli_query($conn, $sql);
?>

<?php require_once "../includes/header.php"; ?>

<div class="page-header">
    <div>
        <div class="page-title">Doctors</div>
        <div class="page-subtitle">All Doctors (<?php echo mysqli_num_rows($result); ?>)</div>
    </div>
    <a href="#" class="btn btn-primary">+ Add New</a>
</div>

<div class="search-bar">
    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search doctors...">
</div>

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Doctor Name</th>
                <th>Email</th>
                <th>Specialization</th>
                <th>Fee</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result) == 0) {
            echo "<tr><td colspan='6' style='text-align:center;padding:32px;color:#8492a6;'>No doctors found.</td></tr>";
        } else {
            $counter = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $counter . "</td>";
                echo "<td style='font-weight:600;'>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['specialization']) . "</td>";
                echo "<td>&#8369;" . number_format($row['docFees'], 2) . "</td>";
                echo "<td style='display:flex;gap:6px;'>";
                echo "<a href='#' class='btn btn-soft btn-sm'>✏ Edit</a>";
                echo "<a href='#' class='btn btn-soft btn-sm'>👁 View</a>";
                echo "<button class='btn btn-danger-soft btn-sm' onclick='openConfirm(\"#\")'>🗑 Remove</button>";
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
