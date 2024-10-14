<?php
// Include database connection
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $specialization = $_POST['specialization'];

    // Check for existing username
    $checkQuery = "SELECT * FROM lab_assistants WHERE username = ?";
    $stmt = $conn->prepare($checkQuery);
    
    if (!$stmt) {
        die("Prepare failed: " . $conn->error); // Check for prepare error
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        // Insert new lab assistant into the database
        $insertQuery = "INSERT INTO lab_assistants (id, username, password, specialization) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        
        if (!$stmt) {
            die("Prepare failed: " . $conn->error); // Check for prepare error
        }

        $stmt->bind_param("isss", $id, $username, $password, $specialization);

        if ($stmt->execute()) {
            echo "Registration successful! You can now log in.";
            // Redirect to login page or any other page
            header("Location: lab_assistant_login.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    $stmt->close();
}
$conn->close();
?>
