<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Book Appointment</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <h1>Book an Appointment</h1>
  <form method="POST" action="book_appointment.php">
    <input type="text" name="name" placeholder="Your Name" required><br>
    <input type="email" name="email" placeholder="Your Email" required><br>
    <select name="doctor_id" required>
      <option value="">Select Doctor</option>
      <?php
        $res = $conn->query("SELECT id, name FROM doctors");
        while($doc = $res->fetch_assoc()) {
            echo "<option value='".$doc['id']."'>".$doc['name']."</option>";
        }
      ?>
    </select><br>
    <input type="date" name="appointment_date" required><br>
    <input type="time" name="appointment_time" required><br>
    <button type="submit">Book</button>
  </form>
</body>
</html>
