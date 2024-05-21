<?php
include 'database_connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New User Registration</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding: 20px;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border: 5px solid greenyellow;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .error {
      color: #ff0000;
      margin-bottom: 10px;
    }

    .link {
      display: block;
      text-align: center;
      margin-top: 20px;
      text-decoration: none;
      color: #007bff;
    }
  </style>
</head>

<body>
  <div class="container">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $booker_name = $_POST['booker_name'];
      $phone_no = $_POST['phone_no'];
      $cid = $_POST['cid'];


      $check_sql = "SELECT * FROM Customer WHERE CID = '$cid'";
      $check_result = $conn->query($check_sql);

      if ($check_result->num_rows > 0) {
        echo "<p class='error'>Error: Customer with CID $cid already exists.</p>";
      } else {

        $insert_sql = "INSERT INTO Customer (CID, Booker_name, Phone_no) VALUES ('$cid', '$booker_name', '$phone_no')";

        if ($conn->query($insert_sql) === TRUE) {
          echo "<p>Successfully created booker account Booker name: $booker_name , Booker id: $cid </p>";

          echo "</ul>";
        } else {
          echo "<p class='error'>Error: " . $insert_sql . "<br>" . $conn->error . "</p>";
        }
      }
    }
    ?>
    <a href="index.html" class="link">Go back to Home</a>
  </div>
</body>

</html>

<?php
$conn->close();
?>