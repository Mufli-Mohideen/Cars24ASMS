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
    // Get data from the form
    $carRegNo = $_POST['carregno'];
    $manufacturer = $_POST['manufacturer'];
    $model = $_POST['model'];
    $owner = $_POST['owner'];
    $phone = $_POST['phone'];

    date_default_timezone_set('Asia/Kolkata');


    // Get current date and time
    $date = date("Y-m-d");
    $time = date("H:i:s");

    // Check if services are selected
    $bodywash = isset($_POST['ChkBodywash']) ? 1 : 0;
    $wax = isset($_POST['ChkWax']) ? 1 : 0;
    $interior = isset($_POST['ChkInteriorClean']) ? 1 : 0;
    $gearoil = isset($_POST['ChkGearOilChange']) ? 1 : 0;
    $engineoil = isset($_POST['ChkEngineOilChange']) ? 1 : 0;

    // Service rates
    $bodywashRate = 1000;
    $waxRate = 3000;
    $interiorRate = 2000;
    $gearoilChangeRate = 5000;
    $engineoilChangeRate = 5000;

    // Calculate the total bill
    $totalBill = 0;
    if ($bodywash) {
        $totalBill = $totalBill + $bodywashRate;
    }
    if ($wax) {
        $totalBill = $totalBill + $waxRate;
    }
    if ($interior) {
        $totalBill += $totalBill + $interiorRate;
    }
    if ($gearoil) {
        $totalBill += $totalBill + $gearoilChangeRate;
    }
    if ($engineoil) {
        $totalBill += $totalBill + $engineoilChangeRate;
    }


    echo "<script>
        var totalBill = '" . $totalBill . "';
        document.getElementById('billInput').value = totalBill;
    </script>";

    // Insert data into the database
    $sql = "INSERT INTO tblcheckin (date, time, carno, manufacturer, model, owner, phone, bodywash, wax, interior, gearoil, engineoil, bill) 
            VALUES ('$date', '$time', '$carRegNo', '$manufacturer', '$model', '$owner', '$phone', $bodywash, $wax, $interior, $gearoil, $engineoil, $totalBill)";






    if (mysqli_query($con, $sql)) {
        // Data inserted successfully
        echo "<script>
        var totalBill = '" . $totalBill . "';
        alert('Check-In successful. Total Bill: ' + totalBill);
        window.location.href = 'staffhome.php';
        </script>";

                      
    } else {
        // Error occurred
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    $sql = "DELETE FROM tblappointment WHERE app_regno = '$carRegNo' AND date = '$date'";

    // Execute the SQL statement
    if (mysqli_query($con, $sql)) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }


    

}

// Close the database connection
mysqli_close($con);
?>
