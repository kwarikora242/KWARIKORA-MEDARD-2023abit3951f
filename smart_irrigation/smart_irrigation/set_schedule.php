<?php
include 'database.php';

$plants = $pdo->query("SELECT * FROM plants")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plant_id = $_POST['plant_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $stmt = $pdo->prepare("INSERT INTO watering_schedule (plant_id, start_time, end_time) VALUES (?, ?, ?)");
    $stmt->execute([$plant_id, $start_time, $end_time]);

    $success = "Schedule set successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Set Watering Schedule</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Set Watering Schedule</h2>
    <?php if (isset($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
    <form method="POST">
        <div class="form-group">
            <label for="plant_id">Plant</label>
            <select name="plant_id" class="form-control" required>
                <?php foreach ($plants as $plant) { ?>
                    <option value="<?= $plant['id'] ?>"><?= htmlspecialchars($plant['plant_name']) ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="time" name="start_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="time" name="end_time" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Set Schedule</button>
    </form>
</div>
</body>
</html>
