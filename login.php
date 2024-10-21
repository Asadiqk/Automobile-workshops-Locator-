<?php
session_start();

// Connect to MySQL
$connection = new mysqli("localhost", "root", "", "workshop_locator");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $connection->real_escape_string($_POST['email']);
    $password = $connection->real_escape_string($_POST['password']);

    // Fetch workshop owner details
    $sql = "SELECT * FROM owners WHERE email='$email'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $owner = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $owner['password'])) {
            // Store owner details in session
            $_SESSION['owner_id'] = $owner['id'];
            $_SESSION['owner_name'] = $owner['name'];

            // Redirect to the page where workshop details can be entered
            header("Location: workshop_form.html");
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "Workshop owner not found!";
    }
}

// Close the connection
$connection->close();
?>
