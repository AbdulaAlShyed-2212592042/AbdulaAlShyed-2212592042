<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Retrieve patient details from session
$patient_id = $_SESSION['patient_id'];
$age = $_SESSION['Age'];
$systolicBP = $_SESSION['SystolicBP'];
$diastolicBP = $_SESSION['DiastolicBP'];
$bs = $_SESSION['BS'];
$bodyTemp = $_SESSION['BodyTemp'];
$heartRate = $_SESSION['HeartRate'];
$riskLevel = $_SESSION['RiskLevel'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('background.jpg'); /* Set the background image */
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h1 {
            text-align: center;
            color: #000; /* Set header text to black */
            text-shadow: none; /* Remove text shadow */
        }
        .patient-info {
            background: rgba(255, 255, 255, 0.9); /* Semi-transparent background */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            margin: auto;
        }
        .info {
            margin: 15px 0;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
        }
        .info strong {
            color: #000; /* Set strong text to black */
            flex: 1;
            text-align: left;
        }
        .info span {
            flex: 2;
            text-align: right;
            color: #000; /* Set span text to black */
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
    <div class="patient-info">
        <h1>Patient Details</h1>
        <div class="info"><strong>Patient ID:</strong> <span><?php echo htmlspecialchars($patient_id); ?></span></div>
        <div class="info"><strong>Age:</strong> <span><?php echo htmlspecialchars($age); ?></span></div>
        <div class="info"><strong>Systolic BP:</strong> <span><?php echo htmlspecialchars($systolicBP); ?></span></div>
        <div class="info"><strong>Diastolic BP:</strong> <span><?php echo htmlspecialchars($diastolicBP); ?></span></div>
        <div class="info"><strong>Blood Sugar (BS):</strong> <span><?php echo htmlspecialchars($bs); ?></span></div>
        <div class="info"><strong>Body Temperature:</strong> <span><?php echo htmlspecialchars($bodyTemp); ?></span></div>
        <div class="info"><strong>Heart Rate:</strong> <span><?php echo htmlspecialchars($heartRate); ?></span></div>
        <div class="info"><strong>Risk Level:</strong> <span><?php echo htmlspecialchars($riskLevel); ?></span></div>
        <form action="logout.php" method="post">
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>
</body>
</html>
