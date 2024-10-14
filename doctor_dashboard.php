<?php
session_start();
include 'connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['patient_id'])) {
    $patient_id = $_POST['patient_id'];

    // Prepare and execute SQL statement to fetch patient details
    $stmt = $conn->prepare("SELECT * FROM data WHERE patient_id = ?");
    $stmt->bind_param("s", $patient_id); // Assuming patient_id is a string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the patient data
        $patient = $result->fetch_assoc();
        $_SESSION['patient'] = $patient; // Store patient details in session
        header("Location: doctor_dashboard.html"); // Redirect to dashboard
    } else {
        header("Location: doctor_dashboard.html?msg=Patient not found"); // Redirect back with message
    }
    $stmt->close();
} else {
    header("Location: doctor_dashboard.html"); // Redirect back if no patient_id is set
}

$conn->close();
?>
