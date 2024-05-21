<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="index.css">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main Page</title>
</head>

<body style="background-image:url(Screenshots/bg9.png); 
height: 120%; background-position: center; background-repeat:
  no-repeat; background-size: cover;height:585px;" align="center">
  <h1>
    <marquee style="color: rgb(141, 7, 7);font-weight: bolder;">Welcome to Railway Booking System</marquee>
  </h1>

  <div class="main" align='center'>
    <h2>
      <a href="see_trains.php">See Trains</a>
      <br><br>
      <a href="see_routes.php">See available routes</a>
      <br><br>
      <a href="book_ticket.php">Book Ticket</a>
      <br><br>

      <a href="http://localhost/dbms_project/index.html">Go to Home Page</a>
    </h2>
  </div>
  <?php

  $booker_name = isset($_GET['booker_name']) ? $_GET['booker_name'] : '';


  if (!empty($booker_name)) {
    echo "<div class='corner-text'>Logged in as: $booker_name</div>";
  }
  ?>

</body>

</html>