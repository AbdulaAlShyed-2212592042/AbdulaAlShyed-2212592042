<?php
// Start session
session_start();

// Database connection
require 'connection.php';

// Function to generate the next patient ID
function generatePatientID($conn) {
    // Query to get the maximum patient ID from the database
    $query = "SELECT MAX(CAST(SUBSTRING(patient_id, 2) AS UNSIGNED)) AS max_id FROM data";
    $result = $conn->query($query);

    if ($result && $row = $result->fetch_assoc()) {
        $max_id = $row['max_id'];
        // Generate the next patient ID by incrementing the max_id and prefixing with 'P'
        return 'P' . str_pad($max_id + 1, 4, '0', STR_PAD_LEFT); // e.g., P0001, P0002...
    } else {
        return 'P0001'; // If no patients, start with P0001
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
    $user_password = $_POST['user_password'];

    // Check if age is valid
    if ($age === false || $age < 0) {
        echo "Invalid age.";
        exit();
    }

    // Generate new patient ID
    $patient_id = generatePatientID($conn);

    // Prepare the SQL statement to insert patient data
    $stmt = $conn->prepare("INSERT INTO data (patient_id, Age, user_password) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $patient_id, $age, $user_password); // Save password as-is

    // Execute the query
    if ($stmt->execute()) {
        // Registration successful, redirect to login.php
        header("Location: login.html");
        exit();
    } else {
        // Error in registration, display error message
        $_SESSION['error_message'] = "Error in registration: " . $stmt->error;
        header("Location: registration.php"); // Redirect back to registration page
        exit();
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
