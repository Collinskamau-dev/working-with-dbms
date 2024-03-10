<?php
// Include database configuration
require_once 'C:/wamp64/www/kollohmbia/config/config.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$weight = $_POST["weight"];
$height = $_POST["height"];
$waistDiameter = $_POST["waistDiameter"];
$timestamp = $_POST["timestamp"];

// Insert data into database
$stmt = $conn->prepare("INSERT INTO user_data (weight, height, waist_diameter, timestamp) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
} else {
    $stmt->bind_param("ddds", $weight, $height, $waistDiameter, $timestamp);
    if (!$stmt->execute()) {
        echo "Error executing statement: " . $stmt->error;
    }
    $stmt->close();
}

// Close connection
$conn->close();

echo "Data inserted successfully!";
