<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $carregno = $_POST["carRegistration"];
    $manufacturer = $_POST["manufacturer"];
    $model = $_POST["year"];
    $mileage = $_POST["mileage"];
    $fuel = $_POST["fuel"];

    // Get the username from the session
    if (isset($_SESSION['username'])) {
        $savedUsername = $_SESSION['username'];

        // Create a connection to the MySQL server
        $con = mysqli_connect("localhost", "root", "");
        mysqli_select_db($con, "cars24db");

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Query the tbluser table to get the associated email for the provided username
        $emailQuery = "SELECT email FROM tbluser WHERE user = '$savedUsername'";
        $emailResult = mysqli_query($con, $emailQuery);

        if ($emailResult && $row = mysqli_fetch_assoc($emailResult)) {
            $savedEmail = $row['email'];

            // Check if the email already exists in tblregcar
            $checkEmailQuery = "SELECT reg_email FROM tblregcar WHERE reg_email = '$savedEmail'";
            $checkEmailResult = mysqli_query($con, $checkEmailQuery);

            if ($checkEmailResult && mysqli_num_rows($checkEmailResult) > 0) {
                // Email already exists, display an error message
                echo '<script>alert("This email is already registered for a car!");</script>';
                echo '<script>window.location.href = "registercar.html";</script>';
            } else {
                // Prepare and execute SQL query to insert data
                $sql = "INSERT INTO tblregcar (regno, manufacturer, model, mileage, fuel, reg_email) 
                        VALUES ('$carregno', '$manufacturer', '$model', $mileage, '$fuel', '$savedEmail')";

                $ret = mysqli_query($con, $sql);

                if ($ret) {

                    // Data inserted successfully, display a JavaScript alert
                    echo '<script>alert("Your car is registered successfully!");</script>';
                    echo '<script>window.location.href = "home.html";</script>';


                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                }
            }
        } else {
            echo "Error retrieving email for the username.";
        }

        // Close the database connection
        mysqli_close($con);
    } else {
        echo "Username not found in the session.";
    }
}
?>
