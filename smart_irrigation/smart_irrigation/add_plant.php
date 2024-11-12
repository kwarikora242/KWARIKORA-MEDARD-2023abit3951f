<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plant_name = $_POST['plant_name'];
    $water_requirement = $_POST['water_requirement'];

    $stmt = $pdo->prepare("INSERT INTO plants (plant_name, water_requirement) VALUES (?, ?)");
    $stmt->execute([$plant_name, $water_requirement]);

    $success = "Plant added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Plant</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Add Plant</h2>
    <?php if (isset($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
    <form method="POST">
        <div class="form-group">
            <label for="plant_name">Plant Name</label>
            <input type="text" name="plant_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="water_requirement">Water Requirement</label>
            <select name="water_requirement" class="form-control" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Plant</button>
    </form>
</div>
</body>
</html>
