<?php
$Passenger_name = $_GET['Passenger_name'];
$Phone_no = $_GET['Phone_no'];
$Class = $_GET['Class'];
$Schedule_id = $_GET['Schedule_id'];
$Seat_number = $_GET['Seat_number'];
$Train_id = $_GET['Train_id'];
$Price = $_GET['Price'];
$ticket_id = $_GET['Ticket_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<link rel='stylesheet' href='index.css'>

<body style="background-image:url(Screenshots/wallpaper1.jpeg); 
height: 120%; background-position: center; background-repeat:
  no-repeat; background-size: cover ;height:580px;">
  <h1 style="color: green;">SUCCESSFULLY BOOKED YOUR TICKET!! HAVE A SAFE JOURNEY</h1>
  <?php

  include "database_connection.php";
  require_once('D:\XAMPP_databse\htdocs\dbms_project\TCPDF-main/tcpdf.php');

  $pdfFilePath = 'D:\XAMPP_databse\htdocs\dbms_project\Tickets\ticket_' . $ticket_id . '.pdf';

  $pdf = new TCPDF();
  $pdf->AddPage();
  $pdf->SetFont('Helvetica', 'B', 16);
  $pdf->Cell(0, 10, 'Railway Ticket', 0, 1, 'C');
  $pdf->SetFont('Helvetica', '', 12);
  $pdf->Cell(0, 10, 'Passenger Name: ' . $Passenger_name, 0, 1);
  $pdf->Cell(0, 10, 'Phone Number: ' . $Phone_no, 0, 1);
  $pdf->Cell(0, 10, 'Class: ' . $Class, 0, 1);
  $pdf->Cell(0, 10, 'Schedule ID: ' . $Schedule_id, 0, 1);
  $pdf->Cell(0, 10, 'Seat Number: ' . $Seat_number, 0, 1);
  $pdf->Cell(0, 10, 'Train ID: ' . $Train_id, 0, 1);
  $pdf->Cell(0, 10, 'Price: ' . $Price, 0, 1);
  $sql_times = "SELECT departure, arrival FROM Train_info WHERE Schedule_id = '$Schedule_id' AND Train_id = '$Train_id'";
  $result_times = $conn->query($sql_times);
  if ($result_times->num_rows > 0) {
    $row = $result_times->fetch_assoc();
    $departure = $row['departure'];
    $arrival = $row['arrival'];

    $pdf->Cell(0, 10, 'Departure: ' . $departure, 0, 1);
    $pdf->Cell(0, 10, 'Arrival: ' . $arrival, 0, 1);
  } else {

    $pdf->Cell(0, 10, 'Departure: N/A', 0, 1);
    $pdf->Cell(0, 10, 'Arrival: N/A', 0, 1);
  }

  $pdf->Output($pdfFilePath, 'F');

  $conn->close();

  ?>
  <div class='out' align='center'>
    <a href='main.php'>Go To Logged In Page</a>
    <br>
    <br>
    <a href='index.html'>Go to Home Page</a>
  </div>
</body>

</html>