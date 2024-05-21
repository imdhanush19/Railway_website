<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Train Details</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    .avail_train {
      background-image: linear-gradient(pink, orange);
      font-size: 20px;
    }

    .out {
      background-color: lightseagreen;
      margin: auto;
      height: 80px;
      width: 230px;
      border: 5px solid greenyellow;
      border-radius: 25px;
      padding: 25px;
      font-size: 20px;
      margin-top: 5%;
    }
  </style>
</head>

<body style="background-image:url(Screenshots/bg9.png); 
height: 120%; background-position: center; background-repeat:
  no-repeat; background-size: cover;">



  <table class='avail_train'>
    <thead>
      <tr>
        <th>Train ID</th>
        <th>Train Name</th>
        <th>Source ID</th>
        <th>Destination ID</th>
        <th>Number of Seats (AC)</th>
        <th>Number of Seats (Non-AC)</th>
        <th>AC Price</th>
        <th>Non-AC Price</th>
        <th>Route ID</th>
      </tr>
    </thead>
    <tbody>
      <?php
      include 'database_connection.php';
      $sql = "SELECT * FROM Train_details";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["Train_id"] . "</td>";
          echo "<td>" . $row["Train_name"] . "</td>";
          echo "<td>" . $row["Source_id"] . "</td>";
          echo "<td>" . $row["Destination_id"] . "</td>";
          echo "<td>" . $row["num_of_seats_ac"] . "</td>";
          echo "<td>" . $row["num_of_seats_nonac"] . "</td>";
          echo "<td>" . $row["ac_price"] . "</td>";
          echo "<td>" . $row["nonac_price"] . "</td>";
          echo "<td>" . $row["Route_id"] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='9'>No data found</td></tr>";
      }


      ?>
    </tbody>
  </table>
  <br>
  <br>
  <div class='out' align='center'>

    <a href='main.php'>Go To Logged In Page</a>

    <br>
    <br>
    <a href='index.html'>Go to Home Page</a>
  </div>
</body>

</html>