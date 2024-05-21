<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
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
    width: 20%;
  }

  th {
    background-color: #ccc;
  }

  .avail_route {
    background-image: linear-gradient(grey, white);
    font-size: 20px;
  }

  .tbod:nth-child(odd) {
    background-color: peru;
  }

  .tbod:nth-child(even) {
    background-color: palevioletred;
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
    position: relative;

  }
</style>

<body style="background-image:url(Screenshots/bg9.png); 
height: 120%; background-position: center; background-repeat:
  no-repeat; background-size: cover;">
  <table class='avail_route'>

    <thead>
      <tr>
        <td>Route_id</td>
        <td>Route_name</td>
      </tr>
    </thead>


    <tbody class="tbod">
      <?php
      include 'database_connection.php';

      $sql_query = "SELECT * FROM Route";
      $result = $conn->query($sql_query);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["Route_id"] . "</td>";
          echo "<td>" . $row["Route_name"] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='9'>No data found</td></tr>";
      }
      ?>
    </tbody>
  </table>
  <div class='out' align='center'>

    <a href='main.php'>Go To Logged In Page</a>

    <br>
    <br>
    <a href='index.html'>Go to Home Page</a>
  </div>


</body>

</html>