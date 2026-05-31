<?php
// ============================================================
// appointments/delete.php — Delete Appointment (DELETE)
// ============================================================
// This is the "D" in CRUD.
//
// This page has NO HTML — it only deletes and redirects.
// The user never "sees" this page directly.
//
// HOW IT WORKS:
// 1. JavaScript shows a confirmation popup
// 2. If user clicks "Yes, Delete", the browser goes to:
//    delete.php?id=3
// 3. This file reads the ID, deletes the row, and redirects back
// ============================================================
require_once "../includes/db.php";

// Read the ID from the URL
$id = (int) $_GET['id'];

// If no valid ID, just go back
if ($id <= 0) {
    header("Location: index.php");
    exit;
}

// ============================================================
// SQL DELETE: removes the row with the matching ID.
//
// DELETE FROM tablename WHERE id = ?
//
// The WHERE clause limits the delete to ONLY that one row.
// Without WHERE, ALL rows would be deleted!
//
// We use a prepared statement to safely pass the $id.
// ============================================================
$stmt = mysqli_prepare($conn, "DELETE FROM appointmenttb WHERE id = ?");

// "i" means the value is an integer
mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

// Redirect back to the list with a success message in the URL
header("Location: index.php?msg=deleted");
exit;
?>
