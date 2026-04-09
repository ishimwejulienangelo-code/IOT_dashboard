<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iot project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate inputs
$temp = isset($_GET['temperature']) ? $_GET['temperature'] : null;
$hum = isset($_GET['humidity']) ? $_GET['humidity'] : null;

if ($temp === null || $hum === null) {
    die("Error: Missing temperature or humidity parameter");
}

// Safe prepared statement (prevents SQL injection)
$stmt = $conn->prepare("INSERT INTO sensor_data (temperature, humidity) VALUES (?, ?)");
$stmt->bind_param("ss", $temp, $hum);

if ($stmt->execute()) {
    echo "Data inserted";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>