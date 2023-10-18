<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the appointment details from the form
    $service = $_POST["service"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    // Get the username from the session
    $username = $_SESSION['username'];

    // Create a connection to the MySQL server
    $con = mysqli_connect("localhost", "root", "");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Select the database
    mysqli_select_db($con, "cars24db");

    // Retrieve the user's email using their username
    $userEmailQuery = "SELECT email FROM tbluser WHERE user='$username'";
    $userEmailResult = mysqli_query($con, $userEmailQuery);

    if ($userEmailResult && mysqli_num_rows($userEmailResult) > 0) {
        $userRow = mysqli_fetch_assoc($userEmailResult);
        $userEmail = $userRow['email'];

        // Retrieve the car's regno using the user's email
        $regNoQuery = "SELECT regno FROM tblregcar WHERE reg_email='$userEmail'";
        $regNoResult = mysqli_query($con, $regNoQuery);

        if ($regNoResult && mysqli_num_rows($regNoResult) > 0) {
            $regNoRow = mysqli_fetch_assoc($regNoResult);
            $regNo = $regNoRow['regno'];

            // Insert the appointment into tblappointment
            $insertQuery = "INSERT INTO tblappointment (user, app_regno, date, time, service) VALUES ('$username', '$regNo', '$date', '$time', '$service')";
            $insertResult = mysqli_query($con, $insertQuery);

            if ($insertResult) {
                echo '<script>alert("Appointment successfully created!");</script>';
                echo '<script>alert($username+" "+$regNo)</script>';
                echo '<script>window.location.href = "home.html";</script>';
            } else {
                echo '<script>alert("Error creating appointment. Please try again.");</script>';
            }
        }
    }

    // Close the database connection
    mysqli_close($con);
}
?>
