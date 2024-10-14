<?php
// doctor_register.php
include('connection.php'); // Include the connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $doctor_id = $_POST['doctor_id'];
    $degree_name = $_POST['degree_name'];
    $college_name = $_POST['college_name'];

    // Prepare SQL statement
    $sql = "INSERT INTO doctor_admin (username, password, doctor_id, degree_name, college_name) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $password, $doctor_id, $degree_name, $college_name);

    if ($stmt->execute()) {
        echo "Registration successful!";
        // Optionally redirect to the login page or another page
        header("Location: doctor_login.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
