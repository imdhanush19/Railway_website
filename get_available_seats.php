<?php

include 'database_connection.php';

if (isset($_POST['Train_id']) && isset($_POST['Schedule_id']) && isset($_POST['Class'])) {

  $selected_train_id = $_POST['Train_id'];
  $selected_schedule_id = $_POST['Schedule_id'];
  $selected_class = $_POST['Class'];
  $sql = "SELECT seat_number FROM Ticket WHERE Train_id = '$selected_train_id' AND Schedule_id = '$selected_schedule_id' AND Class = '$selected_class'";
  $result = $conn->query($sql);

  $booked_seats = array();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $booked_seats[] = $row['seat_number'];
    }
  }


  $total_seats = 100;

  $available_seats = array();


  for ($i = 1; $i <= $total_seats; $i++) {
    if (!in_array($i, $booked_seats)) {
      $available_seats[] = $i;
    }
  }

  $available_seats_str = implode('    ', $available_seats);

  echo $available_seats_str;
} else {

  echo "Error: Please provide Train ID, Schedule ID, and Class.";
}
