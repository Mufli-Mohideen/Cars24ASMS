<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(images/bg.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 90%;
            padding: 20px;
            background-color: transparent;
            border-radius: 5px;
            text-align: center;
            color: white;
            margin-top: 20px;
        }

        h2 {
            color: white;
            margin-bottom: 20px;
        }

        #generate-button {
            background-color: rgb(255, 191, 0);
            color: #000;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
            font-weight: bold;
        }

        #generate-button:hover {
            background-color: #000;
            color: rgb(255, 191, 0);
            border: 2px solid rgb(255, 191, 0);
        }

        #generate-button:active {
            transform: scale(0.98);
        }

        #qr-container {
            max-width: 600px;
            max-height: 600px;
            margin: 10px auto;
            display: none;
        }

        #qr-code-image {
            max-width: 100%;
            max-height: 100%;
            height: auto;
        }

        .glowing-container {
        background-color: black;
        padding: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        border: 2px solid rgb(255, 191, 0);
        box-shadow: 0 0 10px rgba(255, 191, 0, 0.5);
        }


    </style>
</head>
<body>
    <form action="#" method="post">
        <div class="container">
            <div class="center-container">
                <div id="qr-container">
                </div>
            </div>
        </div>
    </form>
    <script>
        document.getElementById("generate-button").addEventListener("click", function() {
            // Show the QR code container when the button is clicked
            document.getElementById("qr-container").style.display = "block";
        });
    </script>
</body>
</html>


<?php
session_start();

if (isset($_SESSION['username'])) {
    $savedUsername = $_SESSION['username'];

    // Create a connection to the MySQL server
    $con = mysqli_connect("localhost", "root", "");
    mysqli_select_db($con, "cars24db");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // SQL query to retrieve the latest check-in data for the specified owner
    $sql = "SELECT date, time, carno, bodywash, wax, interior, gearoil, engineoil 
            FROM tblcheckin 
            WHERE owner = '$savedUsername' 
            ORDER BY date DESC, time DESC 
            LIMIT 1";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the data and store it in variables
        $checkinData = mysqli_fetch_assoc($result);

        // Construct a string with the check-in data
        $codeContents = "Date: {$checkinData['date']}\n";
        $codeContents .= "Time: {$checkinData['time']}\n";
        $codeContents .= "Car Number: {$checkinData['carno']}\n";
        $codeContents .= "Body Wash: " . (($checkinData['bodywash'] == 1) ? 'Done' : 'Not Done') . "\n";
        $codeContents .= "Wax: " . (($checkinData['wax'] == 1) ? 'Done' : 'Not Done') . "\n";
        $codeContents .= "Interior: " . (($checkinData['interior'] == 1) ? 'Done' : 'Not Done') . "\n";
        $codeContents .= "Gear Oil: " . (($checkinData['gearoil'] == 1) ? 'Done' : 'Not Done') . "\n";
        $codeContents .= "Engine Oil: " . (($checkinData['engineoil'] == 1) ? 'Done' : 'Not Done');

        // Include the QR code library
        include('phpqrcode/qrlib.php');

        // Define the directory for saving QR codes
        $tempDir = "qrcodes/";

        // Generate a unique filename for the QR code
        $fileName = 'qr_' . md5($codeContents) . '.png';

        // Define the absolute and relative file paths
        $pngAbsoluteFilePath = $tempDir . $fileName;
        $urlRelativeFilePath = $tempDir . $fileName;

        // Generate the QR code
        QRcode::png($codeContents, $pngAbsoluteFilePath);

        // Display the QR code within a black container with a glowing border
        echo '<div class="glowing-container">';
        echo '<img src="' . $urlRelativeFilePath . '" width="300" height="300" />';
        echo '<p style="color: rgb(255, 191, 0); font-weight: bold; font-size: 24px;">QR Code</p>';
        echo '</div>';

    } else {
        echo "No check-in records available for $savedUsername";
    }
}

?>