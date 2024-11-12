<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

echo "<h1>Welcome to Smart Irrigation Dashboard</h1>";
echo "<a href='add_plant.php'>Add Plant</a> | ";
echo "<a href='set_schedule.php'>Set Watering Schedule</a> | ";
echo "<a href='moisture_log.php'>Log Moisture Level</a> | ";
echo "<a href='irrigation_control.php'>Check Watering Needs</a> | ";
echo "<a href='logout.php'>Logout</a>";
?>
