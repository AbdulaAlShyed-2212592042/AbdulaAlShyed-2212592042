<?php
// Include database connection
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST['id'];
    $password = $_POST['password'];

    // Prepare SQL statement to prevent SQL injection
    $query = "SELECT * FROM lab_assistants WHERE id = ? AND password = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        die("Prepare failed: " . $conn->error); // Check for prepare error
    }

    // Bind parameters and execute
    $stmt->bind_param("ss", $id, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        // Start session and redirect to dashboard
        session_start();
        $_SESSION['id'] = $id; // Store ID in session
        header("Location: lab_assistant_dashboard.html"); // Change to the appropriate dashboard
        exit();
    } else {
        echo "Invalid ID or password.";
    }

    $stmt->close();
}
$conn->close();
?>
