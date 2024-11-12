<?php
include 'database.php';

$plants = $pdo->query("SELECT * FROM plants")->fetchAll();
$moisture_thresholds = ['Low' => 20, 'Medium' => 40, 'High' => 60];

foreach ($plants as $plant) {
    $plant_id = $plant['id'];
    $water_requirement = $plant['water_requirement'];
    $moisture_threshold = $moisture_thresholds[$water_requirement];

    // Get latest moisture level
    $moisture_log = $pdo->prepare("SELECT * FROM moisture_logs WHERE plant_id = ? ORDER BY timestamp DESC LIMIT 1");
    $moisture_log->execute([$plant_id]);
    $latest_log = $moisture_log->fetch();

    if ($latest_log && $latest_log['moisture_level'] < $moisture_threshold) {
        echo "Watering required for plant: " . htmlspecialchars($plant['plant_name']) . "<br>";
    } else {
        echo "No watering needed for plant: " . htmlspecialchars($plant['plant_name']) . "<br>";
    }
}
?>
