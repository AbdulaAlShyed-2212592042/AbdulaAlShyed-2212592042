<?php
// doctor_login.php
session_start();
include('connection.php'); // Include the connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set
    if (isset($_POST['doctor_id']) && isset($_POST['password'])) {
        $doctor_id = $_POST['doctor_id'];
        $password = $_POST['password'];

        // Debugging output (optional, can be removed later)
        echo "<pre>";
        print_r($_POST); // Display posted data for debugging
        echo "</pre>";

        // Prepare SQL statement to prevent SQL injection
        $sql = "SELECT * FROM doctor_admin WHERE doctor_id=? AND password=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $doctor_id, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Successful login
            $_SESSION['doctor_id'] = $doctor_id;
            header("Location: doctor_dashboard.html"); // Redirect to doctor_dashboard.html
            exit(); // Ensure no further code is executed after redirect
        } else {
            echo "<p style='color: red; text-align: center;'>Invalid credentials.</p>";
        }

        $stmt->close();
    } else {
        echo "<p style='color: red; text-align: center;'>Please fill in all fields.</p>";
    }
}
$conn->close();
?>
