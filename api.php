<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '', 'workshop_locator');

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

$city = isset($_GET['city']) ? $_GET['city'] : '';
$city = $conn->real_escape_string($city);

$sql = "SELECT * FROM workshops WHERE city LIKE '%$city%'";
$result = $conn->query($sql);

$workshops = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $workshops[] = $row;
    }
}

echo json_encode($workshops);

$conn->close();
?>
