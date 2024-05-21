<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Verification</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding: 20px;
    }

    .container {
      max-width: 400px;
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

    form {
      margin-top: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="submit"] {
      width: 100%;
      background-color: #007bff;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }

    .error-message {
      color: #ff0000;
      margin-top: 10px;
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="container" align='center'>
    <?php
    include 'database_connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $cid = $_POST['cid'];
      $booker_name = $_POST['booker_name'];

      $check_sql = "SELECT * FROM Customer WHERE CID = '$cid' AND Booker_name = '$booker_name'";
      $check_result = $conn->query($check_sql);

      if ($check_result->num_rows > 0) {

        header('Location: main.php?booker_name=' . urlencode($booker_name));
      } else {

        echo "<p class='error-message'>Error: Customer ID and name do not match.</p>";
      }
    }

    ?>

    <a href='index.html'>Go to Home Page</a>
  </div>
</body>