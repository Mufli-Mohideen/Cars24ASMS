<!DOCTYPE html>
<html>
<head>
  <title>Employee Info</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    /* Your existing CSS styles */
    body {
      margin: 0;
      padding: 0;
      background-image: url(images/bg.jpg);
      background-size: cover;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      width: 100%;
      max-width: 800px; /* Increase the max-width */
      height: 500px; /* Set the height */
      background: rgba(0, 0, 0, 0.8);
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(255, 191, 0, 0.8);
      text-align: center;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .title {
      color: white;
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
      margin-top: 10px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Additional styles for the appointment view container */
    .appointment-container {
      cursor: pointer;
      background: rgba(0, 0, 0, 0.8);
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(255, 191, 0, 0.8);
      text-align: center;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 20px;
    }

    .view-button {
      background-color: rgb(255, 191, 0);
      color: black;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
    }

    .view-button:hover {
      background-color: black;
      color: rgb(255, 191, 0);
      border: 1px solid rgb(255, 191, 0);
    }

    /* Styles for the appointment table */
    table {
      width: 700px;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table, th, td {
      border: 1px solid rgb(255, 191, 0);
    }

    th, td {
      padding: 10px;
      text-align: center;
      color: white;
    }

    th {
      background-color: rgb(255, 191, 0);
      font-weight: bold;
    }

    tr:nth-child(even) {
      background-color: rgba(255, 191, 0, 0.2);
    }


    .delete-container {
      position: absolute;
      top: 10px;
      right: 10px;
      text-align: right;
    }

    .delete-textbox {
      margin-right: 10px;
      padding: 10px;
      border: 1px solid rgb(0, 0, 0);
      border-radius: 5px;
    }

    .delete-button {
      background-color: rgb(255, 191, 0);
      color: black;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }

    .delete-button:hover {
      background-color: black;
      color: rgb(255, 191, 0);
      border: 1px solid rgb(255, 191, 0);
    }

    /* End of your existing styles */
  </style>
</head>
<body>
<form action="#" method="post">
  <div class="container appointment-container">
    <h1 class="title">Employee Info</h1>
    
    <table id="appointment-table">
      <tr>
        <th style="border: 1px solid rgb(0, 0, 0);">Employee ID</th>
        <th style="border: 1px solid rgb(0, 0, 0);">Employee Name</th>
        <th style="border: 1px solid rgb(0, 0, 0);">Address</th>
        <th style="border: 1px solid rgb(0, 0, 0);">Phone</th>
      </tr>
      <?php
        $con = mysqli_connect("localhost", "root", "");

        // Check the connection
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        mysqli_select_db($con, "cars24db");

        // SQL query to select appointments from the tblappointment table
        $sql = "SELECT empID, empname, address, phone FROM tblemp";
        $result = mysqli_query($con, $sql);

        // Check if there are any appointments
        if (mysqli_num_rows($result) > 0) {
          // Output each appointment as a table row
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['empID']}</td>";
            echo "<td>{$row['empname']}</td>";
            echo "<td>{$row['address']}</td>";
            echo "<td>{$row['phone']}</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='5'>No Employees available</td></tr>";
        }

        // Close the database connection
        mysqli_close($con);
      ?>
    </table>
        
  </div>
  </form> 

  <form action="deleteemp.php" method="post">
  <div class="delete-container" style="margin-top: 20px; text-align: center;">
  <input type="text" class="delete-textbox" name="employeeID" placeholder="Delete Employee">
    <button class="delete-button" type="submit">Delete</button>
  </div>
</form>



</body>
</html>