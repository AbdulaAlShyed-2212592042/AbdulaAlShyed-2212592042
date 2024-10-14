<?php
include('connection.php'); // Include the connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $prescription = $_POST['prescription'];

    // Prepare SQL statement to insert prescription
    $sql = "INSERT INTO prescriptions (patient_id, prescription) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $patient_id, $prescription);

    if ($stmt->execute()) {
        echo "Prescription sent successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
