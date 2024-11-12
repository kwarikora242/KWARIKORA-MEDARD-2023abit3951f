<?php
include 'database.php';

$plants = $pdo->query("SELECT * FROM plants")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plant_id = $_POST['plant_id'];
    $moisture_level = $_POST['moisture_level'];

    $stmt = $pdo->prepare("INSERT INTO moisture_logs (plant_id, moisture_level) VALUES (?, ?)");
    $stmt->execute([$plant_id, $moisture_level]);

    $success = "Moisture level logged successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log Soil Moisture</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Log Soil Moisture</h2>
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
            <label for="moisture_level">Moisture Level (0 - 100)</label>
            <input type="number" name="moisture_level" class="form-control" min="0" max="100" required>
        </div>
        <button type="submit" class="btn btn-primary">Log Moisture</button>
    </form>
</div>
</body>
</html>
