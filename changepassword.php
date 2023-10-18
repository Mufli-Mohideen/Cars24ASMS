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
    // Get input from the form
    $staffId = $_POST['staffId'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Query the database to check staff credentials
    $checkSql = "SELECT empID, emppswd FROM tblemp WHERE empID = '$staffId' AND emppswd = '$currentPassword'";
    $checkResult = mysqli_query($con, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        // Staff ID and current password match

        if ($newPassword == $confirmPassword) {
            // New password and confirm password match
            if ($currentPassword != $newPassword) {
                // Current password cannot be the same as the new password
                $updateSql = "UPDATE tblemp SET emppswd = '$newPassword' WHERE empID = '$staffId'";
                if (mysqli_query($con, $updateSql)) {
                    // Password updated successfully
                    echo "<script>
                            alert('Password updated successfully');
                            window.location.href = 'staffportal.php';
                          </script>";
                } else {
                    // Error updating password
                    echo "Error updating password: " . mysqli_error($con);
                }
            } else {
                // Current password and new password are the same
                echo "<script>
                        alert('Current password and new password cannot be the same');
                      </script>";
            }
        } else {
            // New password and confirm password do not match
            echo "<script>
                    alert('New password and confirm password do not match');
                  </script>";
        }
    } else {
        // Staff ID and current password do not match
        echo "<script>
                alert('Staff ID and current password do not match');
              </script>";
    }
}

// Close the database connection
mysqli_close($con);
?>
