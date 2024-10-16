<?php
// Start session
session_start();

// Check if the lab assistant is logged in
if (!isset($_SESSION['id'])) {
    header("Location: lab_assistant_login.html"); // Redirect to login if not logged in
    exit();
}

// Include the HTML content for the dashboard
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Assistant Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('background.jpg'); /* Set the background image */
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
            margin: 0;
            padding: 0;
            color: #fff;
        }
        .dashboard {
            max-width: 600px;
            margin: 100px auto;
            background: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }
        h1 {
            text-align: center;
            color: #5cb85c; /* Set header color */
        }
        .dashboard a {
            display: block;
            padding: 10px;
            background: #5cb85c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            margin: 10px 0;
            transition: background 0.3s;
        }
        .dashboard a:hover {
            background: #4cae4c;
        }
        .logout-button {
            display: block;
            width: 100%;
            padding: 12px;
            background: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            transition: background 0.3s;
        }
        .logout-button:hover {
            background: #c82333;
        }
    </style>
</head>
<body>

<div class="dashboard">
    <h1>Lab Assistant Dashboard</h1>
    <a href="patient.php">View Patient Details</a>
    <a href="edit_patient_data.php">Edit Patient Data</a>
    <form action="logout.php" method="post">
        <button type="submit" class="logout-button">Logout</button>
    </form>
</div>

</body>
</html>
