<?php
// Create a connection to the MySQL database
$con = mysqli_connect("localhost", "root", "", "cars24db");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve data from the HTML form
$employeeId = $_POST['employeeId'];
$employeeName = $_POST['employeeName'];
$employeeAddress = $_POST['employeeAddress'];
$employeePhone = $_POST['employeePhone'];
$employeePassword = $_POST['employeePassword'];

// SQL query to insert the data into the tblemp table
$sql = "INSERT INTO tblemp (empID, empname, address, phone, emppswd) VALUES ('$employeeId', '$employeeName', '$employeeAddress', '$employeePhone', '$employeePassword')";

if (mysqli_query($con, $sql)) {
    echo '<script type="text/javascript">alert("Employee data has been successfully inserted into the database.");';
    echo 'window.location.href = "addemp.html";</script>';
} else {
    echo '<script type="text/javascript">alert("Error: ' . $sql . '\n' . mysqli_error($con) . '");</script>';
}

// Close the database connection
mysqli_close($con);
?>
