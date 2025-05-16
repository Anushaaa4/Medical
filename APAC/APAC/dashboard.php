<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include('config.php');
?>
<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title></head>
<body>
<h2>Welcome, <?= $_SESSION['user']; ?> | <a href="logout.php">Logout</a></h2>

<h3>All Appointments</h3>
<table border="1">
<tr><th>ID</th><th>Name</th><th>Doctor</th><th>Date</th><th>Time</th><th>Action</th></tr>
<?php
$sql = "SELECT appointments.*, doctors.name AS doc_name FROM appointments
        JOIN doctors ON appointments.doctor_id = doctors.id";
$res = $conn->query($sql);
while($row = $res->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['doc_name']}</td>
            <td>{$row['appointment_date']}</td>
            <td>{$row['appointment_time']}</td>
            <td><a href='cancel.php?id={$row['id']}'>Cancel</a></td>
          </tr>";
}
?>
</table>
</body>
</html>
