<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["txtLUserName"]) && isset($_GET["txtLPassword"])) {
    $Username = $_GET["txtLUserName"];
    $Password = $_GET["txtLPassword"];

    // Create a connection to the MySQL server
    $con = mysqli_connect("localhost", "root", "");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Select the database
    mysqli_select_db($con, "cars24db");

    // Perform SQL to retrieve the user based on the provided username and password
    $sql = "SELECT * FROM tbluser WHERE user='$Username' AND psswd='$Password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {

        // Username and password match, display a welcome message using JavaScript
        echo '<script>alert("Welcome, ' . $Username . '!");</script>';
        $_SESSION['username'] = $Username;
        echo '<script>window.location.href = "home.html";</script>';
        exit();
    } else {
        // Username and password do not match, display an error message
        echo '<script>alert("Incorrect User Name or Password");</script>';
        echo '<script>window.history.go(-1);</script>';
    }

    // Close the database connection
    mysqli_close($con);
}
?>