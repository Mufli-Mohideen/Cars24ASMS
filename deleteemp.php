<?php
// Establish a database connection
$con = mysqli_connect("localhost", "root", "");

// Check the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select the database
mysqli_select_db($con, "cars24db");

// Check if the empID is provided in the POST data
if (isset($_POST["employeeID"])) {
    // Sanitize and retrieve the empID from the POST data
    $empID = mysqli_real_escape_string($con, $_POST["employeeID"]);

    // Define your SQL query to select the employee with the provided ID
    $selectQuery = "SELECT empID FROM tblemp WHERE empID = '$empID'";
    $result = mysqli_query($con, $selectQuery);

    // Check if an employee with the given ID exists
    if (mysqli_num_rows($result) == 0) {
        // Display an error message
        echo '<script type="text/javascript">alert("Employee with the provided ID does not exist.");</script>';
    } else {
        // Define your SQL query to delete the employee based on empID
        $deleteQuery = "DELETE FROM tblemp WHERE empID = '$empID'";

        // Execute the SQL query
        if (mysqli_query($con, $deleteQuery)) {
            // Display a success message
            echo '<script type="text/javascript">alert("Employee with ID ' . $empID . ' has been deleted successfully.");</script>';
            // Redirect to viewemp.php
            header("Location: viewemp.php");
            exit;
        } else {
            // Display an error message for the deletion query
            echo '<script type="text/javascript">alert("Error deleting employee: ' . mysqli_error($con) . '");</script>';
        }
    }
} else {
    // Display an error message for missing employee ID
    echo '<script type="text/javascript">alert("Employee ID not provided in the form data.");</script>';
}

// Close the database connection
mysqli_close($con);
?>
