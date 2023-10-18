<!DOCTYPE html>
<html>
<head>
  <title>Vehicle Check-In Record and Appointments</title>
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha384-...">
  <style>

  @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,900&family=Roboto+Slab&display=swap');
  
  @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,900&family=Roboto+Slab:wght@400;600;700&display=swap');

 
  @import url('https://fonts.googleapis.com/css2?family=Monda:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,900&family=Roboto+Slab:wght@400;600;700&display=swap');

    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      flex-direction: column;
      background-image: url(images/bg.jpg); /* Replace 'your-background-image.jpg' with your image file path */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      min-height: 100vh;
    } 

    .container {
      display: flex;
      flex: 1;
    }

    .first-part {
      width: 75%;
      background-color: rgba(0, 0, 0, 0.9); /* Semi-transparent white background */
      padding: 20px;
      border-right: 1px solid #c0c0c0;
      flex: 1;
    }

    .title {
      text-align: center; /* Center-align the title */
      font-size: 24px;
      font-weight: bold;
      color: rgb(255, 191, 0);
      margin-bottom: 20px;
      font-family: 'Poppins', sans-serif;
    }

    .form-group {
      display: flex;
      flex-direction: row; /* Ensure labels and text boxes are in one row */
      align-items: center;
      margin-bottom: 20px;
    }

    .label {
      color: rgb(255, 191, 0);
      width: 150px; /* Adjust the width as needed to align labels uniformly */
      display: flex;
      justify-content: space-between; /* Place the search icon on the right */
      align-items: center;
    }

    .label i {
      margin-left: 10px; /* Adjust the spacing between the label and the icon */
    }

    .text-box {
      flex: 1; /* Allow text boxes to expand to fill available space */
      padding: 10px;
      border: 1px solid #c0c0c0;
      border-radius: 5px;
    }
    .text-box:hover{
      border: 1px solid rgb(255, 191, 0);
    }

    .label{
      font-family: 'Poppins', sans-serif;
    }

    .label-checkbox{
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .combo-box {
      padding: 10px;
      border: 1px solid #c0c0c0;
      border-radius: 5px;
    }

    .button-container {
      display: flex;
      justify-content: space-between;
      margin-top: 35px;
    }

    .button {
      background-color: rgb(255, 191, 0);
      color: black;
      border: 1px solid black;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 5px;
      font-weight: bold;
    }

    .button:hover{
      background-color: #000000;
      color: rgb(255, 191, 0);
      border: 1px solid rgb(255, 191, 0);
    }

    .bill {
      margin-top: 40px;
    }

    .second-part {
      width: 25%;
      background-color: rgb(0, 0, 0);
      padding: 20px;
      color: rgb(255, 255, 255);
      height:auto;
      border: 1px solid rgb(255, 191, 0);
    }

    .appointments-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }
    
    hr.glow {
      border: none;
      height: 5px; /* Adjust the height of the glow effect */
      background: linear-gradient(90deg, transparent, rgba(255, 191, 0, 0.8), transparent); /* Adjust the opacity and color here */
      animation: glow 1.5s linear infinite;
    }

    @keyframes glow {
      0% {
        background-position: 100%;
      }
      100% {
        background-position: -100%;
      }
    }

    .analog-clock {
    width: 200px;
    height: 200px;
    margin: 0 auto;
    position: relative;
    border: 5px solid rgb(255,191,0);
    border-radius: 50%;
}

.clock-face {
    width: 10px;
    height: 10px;
    background: rgb(255,255,255);
    border-radius: 50%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.hour-hand, .minute-hand, .second-hand {
    background: rgb(255,191,0);
    position: absolute;
    top: 50%;
    left: 50%;
    transform-origin: 50% 100%;
}

.hour-hand {
    width: 5px;
    height: 40px;
    z-index: 3;
}

.minute-hand {
    width: 3px;
    height: 60px;
    z-index: 2;
}

.second-hand {
    width: 1px;
    height: 70px;
    background: rgb(255,191,0);
    z-index: 1;
}

/* Adjust rotation angles for clock hands using CSS animations */
.hour-hand {
    animation: rotate 43200s steps(12) infinite;
}

.minute-hand {
    animation: rotate 3600s steps(60) infinite;
}

.second-hand {
    animation: rotate 60s steps(60) infinite;
}

@keyframes rotate {
    from {
        transform: translate(-50%, -100%) rotate(0deg);
    }
    to {
        transform: translate(-50%, -100%) rotate(360deg);
    }
}

    
  </style>
</head>
<body>
  
  <div class="container">
    

    <div class="first-part">
        
      <h1 class="title" style="margin-top: 10px;">Vehicle Check-In Record</h1>
      <form action="#" method="post">
      <div class="form-group" style="margin-top: 30px; display: flex; align-items: center; justify-content: center;">
        <label class="label" style="margin-right: 5px; font-weight: bold;">Find Car Info :</label>
        <div class="horizontal-container">
          <input type="text" class="text-box" style="margin-right: 5px;" name="searchreg">
          <button class="button">Search
            <i class="fas fa-search search-icon"></i>
          </button>
        </div>
      </div>
      </form>
      
      <hr class="glow">
      <form action="checkin.php" method="post" onsubmit="return validateForm();">
      <div class="form-group" style="margin-top: 40px;">
        <label class="label">Car Reg No</label>
        <input type="text" class="text-box" name="carregno" required>
      </div>

      <div class="form-group">
        <label class="label">Manufacturer</label>
        <select class="combo-box" name="manufacturer" required>
          <option value="Toyota">Toyota</option>
          <option value="Suzuki">Suzuki</option>
          <option value="Mazda">Mazda</option>
          <option value="Honda">Honda</option>
          <option value="Range Rover">Range Rover</option>
          <option value="BMW">BMW</option>
          <option value="Benz">Benz</option>
        </select>
      </div>

      <div class="form-group">
        <label class="label">Model</label>
        <input type="text" class="text-box" name="model" required>
      </div>

      <div class="form-group">
        <label class="label">Owner Name</label>
        <input type="text" class="text-box" name="owner" required>
      </div>

      <div class="form-group">
        <label class="label">Phone</label>
        <input type="text" class="text-box" name="phone" required>
      </div>

      <div class="form-group">
        <label class="label checkbox">Required Services</label>
        <label for="Bodywash" style="color: rgb(255, 191, 0);"><input type="checkbox" name="ChkBodywash" id="BodyWash">BodyWash</label>
        <label for="Wax" style="color: rgb(255, 191, 0); margin-left: 20px;"><input type="checkbox" name="ChkWax" id="Wax">Wax</label>
        <label for="InteriorClean" style="color: rgb(255, 191, 0); margin-left: 20px;"><input type="checkbox" name="ChkInteriorClean" id="InteriorClean">Interior Clean</label>
        <label for="GearOilChange" style="color: rgb(255, 191, 0); margin-left: 20px;"><input type="checkbox" name="ChkGearOilChange" id="GearOilChange">Gear Oil Change</label>
        <label for="EngineOilChange" style="color: rgb(255, 191, 0); margin-left: 20px;"><input type="checkbox" name="ChkEngineOilChange" id="EngineOilChange">Engine Oil Change</label>
      </div>

      <div class="button-container" style="display: flex; justify-content: center;">
        <button class="button" style="margin-right: 580px;">Confirm</button>
        <button class="button">Clear</button>
      </div>

      <div class="form-group bill" style="background-color: rgb(0, 0, 0); padding: 15px; border-radius: 5px; margin-bottom: 2px; position: relative; border: 1px solid transparent; box-shadow: 0 0 10px rgba(255, 191, 0, 1);">
        <label style="color: rgb(255, 191, 0); font-family: cursive; text-align: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Your contentment is our top priority; we're dedicated to delivering exceptional customer satisfaction</label>
        <label style="color: rgb(255, 191, 0); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold; margin-left: 25px;">: CARS24 - TEAM</label>
      </div>
    </form>
    </div>

    


    <div class="second-part">

      <h1 class="appointments-title" style="text-align: center; font-family: 'Monda', sans-serif;">Appointments</h1>
      <button class="button" style="margin: 20px auto; display: block;" onclick="redirectToAppointments()">View Appointments</button>
      <hr class="glow">

      <div class="analog-clock" style="margin-top: 80px;">
        <div class="hour-hand"></div>
        <div class="minute-hand"></div>
        <div class="second-hand"></div>
        <div class="clock-face"></div>
      </div>

    </div>
    

  </div>

  <script>

function updateClock() {
    const hourHand = document.querySelector('.hour-hand');
    const minuteHand = document.querySelector('.minute-hand');
    const secondHand = document.querySelector('.second-hand');

    const now = new Date();
    const hours = now.getHours() % 12;
    const minutes = now.getMinutes();
    const seconds = now.getSeconds();

    const hourDeg = (360 / 12) * (hours % 12) + (360 / 12) * (minutes / 60);
    const minuteDeg = (360 / 60) * minutes;
    const secondDeg = (360 / 60) * seconds;

    // Set the initial rotation of the clock hands
    hourHand.style.transform = `rotate(${hourDeg}deg)`;
    minuteHand.style.transform = `rotate(${minuteDeg}deg)`;
    secondHand.style.transform = `rotate(${secondDeg}deg)`;

    // Update the clock hands every second
    setInterval(() => {
        const now = new Date();
        const seconds = now.getSeconds();
        const secondDeg = (360 / 60) * seconds;
        secondHand.style.transform = `rotate(${secondDeg}deg)`;
    }, 1000);
}



    function validateForm() {
      var checkboxes = document.querySelectorAll('input[type="checkbox"]');
      var atLeastOneChecked = false;
  
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
          atLeastOneChecked = true;
          break;
        }
      }
  
      if (!atLeastOneChecked) {
        alert('Please select at least one service.');
        return false;
      }
    }

    function redirectToAppointments() {
    window.location.href = "viewappointment.php";
    }



  </script>


</body>
</html>

<?php
// Assuming you have already established a database connection as you mentioned in previous questions.
$con = mysqli_connect("localhost", "root", "");

    // Check the connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_select_db($con, "cars24db");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form has been submitted.

    
    // Get the car registration number from the form input.
    $carregno = $_POST['searchreg'];

    // Query the tblregcar to check if the car is registered.
    $sql = "SELECT * FROM tblregcar WHERE regno = '$carregno'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Car is registered, fetch details and populate the form.

        $row = mysqli_fetch_assoc($result);

        // Manufacturer
        $manufacturer = $row['manufacturer'];

        // Model
        $model = $row['model'];

        // Registration email
        $reg_email = $row['reg_email'];

        // Query the tbluser to get the owner.
        $sql = "SELECT user FROM tbluser WHERE email = '$reg_email'";
        $result = mysqli_query($con, $sql);
        $owner = ($row = mysqli_fetch_assoc($result)) ? $row['user'] : "";

        echo '<script>';
        echo "document.getElementsByName('carregno')[0].value = '" . $carregno . "';";
        echo "document.getElementsByName('manufacturer')[0].value = '" . $manufacturer . "';";
        echo "document.getElementsByName('model')[0].value = '" . $model . "';";
        echo "document.getElementsByName('owner')[0].value = '" . $owner . "';";
        echo '</script>';


    } else {
        // Car is not registered, show an error message.
        echo "<script>alert('Not a registered car.');</script>";
        // You can redirect or take other actions here if needed.
    }
} else {
    // Default values for form fields if not submitted.
    $carregno = $manufacturer = $model = $owner = "";
}

?>
