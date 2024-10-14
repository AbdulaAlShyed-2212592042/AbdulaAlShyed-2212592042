<?php
// Start session
session_start();

// Database connection
require 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $user_password = $_POST['user_password'];

    // Prepare and bind SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT patient_id, Age, SystolicBP, DiastolicBP, BS, BodyTemp, HeartRate, RiskLevel, user_password FROM data WHERE patient_id = ?");
    $stmt->bind_param("s", $patient_id);
    
    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        
        // Compare plain-text passwords directly
        if ($user_password === $row['user_password']) {
            // Store patient details in session
            $_SESSION['patient_id'] = $row['patient_id'];
            $_SESSION['Age'] = $row['Age'];
            $_SESSION['SystolicBP'] = $row['SystolicBP'];
            $_SESSION['DiastolicBP'] = $row['DiastolicBP'];
            $_SESSION['BS'] = $row['BS'];
            $_SESSION['BodyTemp'] = $row['BodyTemp'];
            $_SESSION['HeartRate'] = $row['HeartRate'];
            $_SESSION['RiskLevel'] = $row['RiskLevel'];
            
            // Redirect to patient.php
            header("Location: patient.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Invalid patient ID!";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

