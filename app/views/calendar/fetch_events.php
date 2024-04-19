<?php
// Connect to your database (replace placeholders with actual database credentials)
$servername = "localhost";
$username = "phpuser";
$password = "phpuser";
$dbname = "fitness_db";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date = $_GET['date'];
$sql = "SELECT * FROM classes WHERE class_date = '$date'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $events = "";
    while ($row = $result->fetch_assoc()) {
        $events .= "{$row['class_title']}: {$row['class_description']}\n";
    }
    echo $events;
} else {
    echo "No events found for this date.";
}

$conn->close();





