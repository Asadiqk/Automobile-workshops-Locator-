<?php
// Connect to MySQL
$connection = new mysqli("localhost", "root", "", "workshop_locator");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $connection->real_escape_string($_POST['username']);
    $email = $connection->real_escape_string($_POST['email']);
    $password = $connection->real_escape_string($_POST['password']);
    $confirm_password = $connection->real_escape_string($_POST['confirm_password']);

    // Validate passwords
    if ($password !== $confirm_password) {
        die("Passwords do not match");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $sql = "INSERT INTO owners (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
    if ($connection->query($sql) === TRUE) {
        echo "Sign up successful! <a href='login.html'>Login here</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Close the connection
$connection->close();
?>
