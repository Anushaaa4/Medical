<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Our Doctors</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <h1>Our Doctors</h1>
  <?php
    $sql = "SELECT * FROM doctors";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        echo "<div class='doctor'>";
        echo "<img src='".$row['profile_pic']."' width='100'>";
        echo "<h3>".$row['name']."</h3>";
        echo "<p>".$row['specialty']."</p>";
        echo "<p>Available: ".$row['availability']."</p>";
        echo "</div>";
    }
  ?>
</body>
</html>
