<!DOCTYPE html>
<html>

<head>
  <title>Ticket Booking</title>
</head>
<link rel='stylesheet' href='index.css'>
<script>
  function func() {
    var trainId = document.getElementById('Train_id').value;
    var scheduleId = document.getElementById('Schedule_id').value;
    var selectedClass = document.getElementById('Class').value;

    if (trainId && scheduleId && selectedClass) {
      fetch('get_available_seats.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: 'Train_id=' + trainId + '&Schedule_id=' + scheduleId + '&Class=' + selectedClass
        })
        .then(response => response.text())
        .then(data => {
          alert('Available Seats: ' + data);
        })
        .catch(error => {
          console.error('Error fetching available seats:', error);
        });
    } else {
      alert('Please select Train ID, Schedule ID, and Class.');
    }
  }
</script>


<body style="background-image:url(Screenshots/bg9.png); 
height: 120%; background-position: center; background-repeat:
  no-repeat; background-size: cover;">

  <form method="post" action="insert_book.php" class='book' align='center'>
    <label for="Passenger_name">Passenger Name:</label><br>
    <input type="text" id="Passenger_name" name="Passenger_name" required>
    <br><br>

    <label for="Phone_no">Phone Number:</label><br>
    <input type="text" id="Phone_no" name="Phone_no" required>
    <br><br>
    <label for="Class">Class:</label><br>
    <select id="Class" name="Class" required>
      <option>Select Class</option>
      <option value="AC">AC</option>
      <option value="NONAC">Non-AC</option>
    </select><br>
    <br>
    <label for="Train_id">Train ID:</label><br>
    <select id="Train_id" name="Train_id" required>
      <?php
      include 'database_connection.php';
      $sql = "SELECT Train_id, Train_name FROM Train_details";
      $result = $conn->query($sql);
      echo "<option value>" . "------------------------------Select----------------------------" . "</option>";
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<option value='" . $row['Train_id'] . "'>" . $row['Train_id'] . " - " . "(" . $row['Train_name'] . ")</option>";
        }
      }
      ?>
    </select>
    <br><br>
    <label for="Schedule_id">Schedule ID:</label><br>
    <select id="Schedule_id" name="Schedule_id" required>
      <?php


      echo "<option>" . "------------------------------------------------------Select------------------------------------------------" . "</option>";
      $current_date = date("Y-m-d H:i:s");
      $sql = "SELECT Schedule_id, departure, arrival FROM Train_info WHERE departure > '$current_date'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<option value='" . $row['Schedule_id'] . "'>" . $row['Schedule_id'] . " (Departure: " . $row['departure'] . " - Arrival: " . $row['arrival'] . ")</option>";
        }
      }
      ?>
    </select>
    <br><br>
    <label for="Seat_number">Seat Number:</label><br>
    <input type="number" id="Seat_number" name="Seat_number" min="1" max="100" required>
    <br><br>
    <button type="button" onclick="func()">Get Available seats</button>
    <br><br>

    <input type="submit" value="Book Ticket">
  </form>

  <div class='out' align='center'>

    <a href='main.php'>Go To Logged In Page</a>

    <br>
    <br>
    <a href='index.html'>Go to Home Page</a>
  </div>
</body>

</html>