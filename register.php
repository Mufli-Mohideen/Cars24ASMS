<?php
session_start();

$Username = $_GET["txtUsername"];
$Email = $_GET["txtEmail"];
$Password = $_GET["txtPassword"];


// Create a connection to the MySQL server
$con = mysqli_connect("localhost", "root", "");

// Select the database
mysqli_select_db($con, "cars24db");

// Check if the username already exists
$checkQuery = "SELECT * FROM tbluser WHERE user = '$Username'";
$checkResult = mysqli_query($con, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    // Username already exists, display a message
    echo '<script>alert("Username already exists. Please try another name.");</script>';
    echo '<script>window.history.go(-1);</script>';
} else {
    // Username is unique, proceed with data insertion
    $insertQuery = "INSERT INTO tbluser (email, user, psswd) VALUES ('$Email', '$Username', '$Password')";
    $ret = mysqli_query($con, $insertQuery);

    if ($ret) {
        // Data inserted successfully, display a JavaScript alert
        echo '<script>alert("Data inserted successfully!");</script>';
        echo '<script>window.history.go(-1);</script>';
    } else {
        echo "Error inserting data: " . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>
