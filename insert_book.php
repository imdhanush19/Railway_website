<?php

include 'database_connection.php';

$Passenger_name = $_POST['Passenger_name'];
$Phone_no = $_POST['Phone_no'];
$Class = $_POST['Class'];
$Schedule_id = $_POST['Schedule_id'];
$Seat_number = $_POST['Seat_number'];
$Train_id = $_POST['Train_id'];

$sql_check_seat = "SELECT * FROM Ticket WHERE Schedule_id = '$Schedule_id' AND Seat_number = $Seat_number";
$result_check_seat = $conn->query($sql_check_seat);

if ($result_check_seat->num_rows > 0) {
  echo "<h1>Seat number $Seat_number is already booked for the selected schedule and class.</h1>";
} else {

  $sql_check_train = "SELECT * FROM Train_info WHERE Schedule_id = '$Schedule_id' AND Train_id = $Train_id";
  $result_check_train = $conn->query($sql_check_train);

  if ($result_check_train->num_rows > 0) {

    $sql_price = "SELECT " . $Class . "_price AS price FROM Train_details WHERE Train_id = $Train_id";
    $result_price = $conn->query($sql_price);
    $row_price = $result_price->fetch_assoc();
    $Price = $row_price['price'];

    $sql_seats = "SELECT num_of_seats_$Class AS seats_available FROM Train_info WHERE Schedule_id = '$Schedule_id'";
    $result_seats = $conn->query($sql_seats);
    $row_seats = $result_seats->fetch_assoc();
    $seats_available = $row_seats['seats_available'];

    if ($seats_available > 0) {
      do {
        $ticket_id = mt_rand(100000, 999999);
        $sql_check_id = "SELECT Ticket_id FROM Ticket WHERE Ticket_id = $ticket_id";
        $result_check_id = $conn->query($sql_check_id);
      } while ($result_check_id->num_rows > 0);

      $sql_insert = "INSERT INTO Ticket (Ticket_id, seat_number, Train_id, Passenger_name, Phone_no, Schedule_id, Price, departure, arrival, Route_id, class) 
                   VALUES ($ticket_id, $Seat_number, $Train_id, '$Passenger_name', $Phone_no, '$Schedule_id', $Price, 
                   (SELECT departure FROM Train_info WHERE Schedule_id = '$Schedule_id'), 
                   (SELECT arrival FROM Train_info WHERE Schedule_id = '$Schedule_id'), 
                   (SELECT Route_id FROM Train_info WHERE Schedule_id = '$Schedule_id'), '$Class')
                   ON DUPLICATE KEY UPDATE 
                   seat_number = VALUES(seat_number), 
                   departure = VALUES(departure), 
                   arrival = VALUES(arrival), 
                   Route_id = VALUES(Route_id), 
                   class = VALUES(class), 
                   Price = VALUES(Price)";

      if ($conn->query($sql_insert) === TRUE) {
        $sql_update_seats = "UPDATE Train_info SET num_of_seats_$Class = num_of_seats_$Class - 1 WHERE Schedule_id = '$Schedule_id'";
        if ($conn->query($sql_update_seats) === TRUE) {
          $url = "ticket_verified.php?Passenger_name=$Passenger_name&Phone_no=$Phone_no&Class=$Class&Schedule_id=$Schedule_id&Seat_number=$Seat_number&Train_id=$Train_id&Price=$Price&Ticket_id=$ticket_id";
          header("Location: $url");
          exit();
        } else {
          echo "<h1>Error updating seats:</h1> " . $conn->error;
        }
      } else {
        echo "<h1>Error booking ticket:</h1> " . $conn->error;
      }
    } else {
      echo "<h1>No seats available for the selected class and schedule.</h1>";
    }
  } else {
    echo "<h1>The selected train is not scheduled for the chosen schedule.</h1>";
  }
}

$conn->close();
