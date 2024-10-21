<?php
session_start();

// Check if the workshop owner is logged in
if (!isset($_SESSION['owner_id'])) {
    header("Location: owner_login.html");
    exit();
}

// Connect to MySQL
$connection = new mysqli("localhost", "root", "", "workshop_locator");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $connection->real_escape_string($_POST['name']);
    $address = $connection->real_escape_string($_POST['address']);
    $city = $connection->real_escape_string($_POST['city']);
    $state = $connection->real_escape_string($_POST['state']);
    $owner_id = $_SESSION['owner_id'];

    // Insert workshop details into the database
    $sql = "INSERT INTO workshops (name, address, city, state, owner_id) 
            VALUES ('$name', '$description', '$contact', '$location', '$owner_id')";
    
    if ($connection->query($sql) === TRUE) {
        echo "Workshop added successfully! <a href='login.html'>continue to index</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}
