<?php
require_once "../includes/db.php";

$id = (int) $_GET['id'];
if ($id <= 0) { header("Location: index.php"); exit; }

$result = mysqli_query($conn, "SELECT * FROM appointmenttb WHERE id = $id");
$appt   = mysqli_fetch_assoc($result);
if (!$appt) { header("Location: index.php"); exit; }

$patients_result = mysqli_query($conn, "SELECT id, fname, lname FROM patreg ORDER BY lname ASC");
$doctors_result  = mysqli_query($conn,
    "SELECT doctb.id, doctb.name, specialtb.specialization
     FROM doctb LEFT JOIN specialtb ON doctb.spec_id = specialtb.id ORDER BY doctb.name ASC"
);

$tomorrow = date('Y-m-d', strtotime('+1 day'));
$errors = [];

function getAllowedSlots(): array {
    $slots = [];
    for ($h = 7; $h <= 11; $h++) {
        $slots['morning'][] = sprintf('%02d:00', $h);
        $slots['morning'][] = sprintf('%02d:30', $h);
    }
    $slots['morning'] = array_filter($slots['morning'], fn($t) => $t <= '11:30');
    for ($h = 13; $h <= 17; $h++) {
        $slots['afternoon'][] = sprintf('%02d:00', $h);
        $slots['afternoon'][] = sprintf('%02d:30', $h);
    }
    $slots['afternoon'] = array_filter($slots['afternoon'], fn($t) => $t <= '17:30');
    return $slots;
}

function toDisplay(string $t): string {
    $h = (int) substr($t, 0, 2);
    $m = substr($t, 3, 2);
    $period = ($h >= 12) ? 'PM' : 'AM';
    $h12    = ($h > 12) ? ($h - 12) : $h;
    return "$h12:$m $period";
}

$slots = getAllowedSlots();

function isAllowedTime(string $t, array $slots): bool {
    $all = array_merge(array_values($slots['morning']), array_values($slots['afternoon']));
    return in_array($t, $all, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pid    = (int) $_POST['pid'];
    $did    = (int) $_POST['did'];
    $apdate = trim($_POST['apdate']);
    $aptime = trim($_POST['aptime']);
    $reason = trim($_POST['reason']);
    $status = trim($_POST['status']);

    if ($pid == 0)    $errors[] = "Please select a patient.";
    if ($did == 0)    $errors[] = "Please select a doctor.";
    if ($apdate == "") { $errors[] = "Please enter the appointment date."; }
    if ($aptime == "") { $errors[] = "Please select a time."; }
    elseif (!isAllowedTime($aptime, $slots)) { $errors[] = "Please select a valid clinic time slot."; }

    if (empty($errors)) {
        $stmt = mysqli_prepare($conn,
            "UPDATE appointmenttb SET pid=?, did=?, apdate=?, aptime=?, reason=?, status=? WHERE id=?"
        );
        mysqli_stmt_bind_param($stmt, "iissssi", $pid, $did, $apdate, $aptime, $reason, $status, $id);
        mysqli_stmt_execute($stmt);
        header("Location: index.php?msg=updated");
        exit;
    }
}
?>

<?php require_once "../includes/header.php"; ?>

<a href="index.php" class="back-link">← Back to Appointments</a>

<div class="form-card">
    <h3>Edit Appointment</h3>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <?php foreach ($errors as $error): ?><p><?php echo $error; ?></p><?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="pid">Patient *</label>
            <select name="pid" id="pid">
                <option value="0">-- Select Patient --</option>
                <?php while ($p = mysqli_fetch_assoc($patients_result)): ?>
                    <option value="<?php echo $p['id']; ?>" <?php echo ($appt['pid'] == $p['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($p['fname'] . ' ' . $p['lname']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="did">Doctor *</label>
            <select name="did" id="did">
                <option value="0">-- Select Doctor --</option>
                <?php while ($d = mysqli_fetch_assoc($doctors_result)): ?>
                    <option value="<?php echo $d['id']; ?>" <?php echo ($appt['did'] == $d['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($d['name'] . ' (' . $d['specialization'] . ')'); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="apdate">Date *</label>
                <input type="date" name="apdate" id="apdate" value="<?php echo $appt['apdate']; ?>">
            </div>
            <div class="form-group">
                <label for="aptime">Time *</label>
                <select name="aptime" id="aptime">
                    <option value="">-- Select Time --</option>
                    <optgroup label="Morning (7:00 AM – 11:30 AM)">
                        <?php foreach ($slots['morning'] as $t): ?>
                            <option value="<?php echo $t; ?>" <?php echo ($appt['aptime'] === $t || substr($appt['aptime'], 0, 5) === $t) ? 'selected' : ''; ?>><?php echo toDisplay($t); ?></option>
                        <?php endforeach; ?>
                    </optgroup>
                    <optgroup label="Afternoon (1:00 PM – 5:30 PM)">
                        <?php foreach ($slots['afternoon'] as $t): ?>
                            <option value="<?php echo $t; ?>" <?php echo ($appt['aptime'] === $t || substr($appt['aptime'], 0, 5) === $t) ? 'selected' : ''; ?>><?php echo toDisplay($t); ?></option>
                        <?php endforeach; ?>
                    </optgroup>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="reason">Reason for Visit</label>
            <textarea name="reason" id="reason" rows="3"><?php echo htmlspecialchars($appt['reason']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status">
                <?php foreach (['Pending','Confirmed','Completed','Cancelled'] as $s): ?>
                    <option value="<?php echo $s; ?>" <?php echo ($appt['status'] === $s) ? 'selected' : ''; ?>><?php echo $s; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Appointment</button>
            <a href="index.php" class="btn btn-gray">Cancel</a>
        </div>
    </form>
</div>

<?php require_once "../includes/footer.php"; ?>
