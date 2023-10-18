<?php
// Establish a database connection
$con = mysqli_connect("localhost", "root", "");

// Check the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select the database
mysqli_select_db($con, "cars24db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get staff ID and password from the form
    $staffId = $_POST['staff-id'];
    $password = $_POST['password'];

    // Query the database to check staff credentials
    $sql = "SELECT empname FROM tblemp WHERE empID = '$staffId' AND emppswd = '$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Credentials are correct
        $row = mysqli_fetch_assoc($result);
        $employeeName = $row["empname"];

        // Use JavaScript to display a welcome message in a prompt box
        //Redirect to staffhome.html
        echo "<script>
                var employeeName = '" . $employeeName . "';
                alert('Welcome, ' + employeeName);
                window.location.href = 'staffhome.php'; 
              </script>";
        
    } else {
        echo "<script>
        alert('Invalid StaffID or Password!');
        window.location.href = 'staffportal.html'; 
      </script>";
    }
}

// Close the database connection
mysqli_close($con);
?>
