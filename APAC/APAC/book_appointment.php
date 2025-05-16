<?php
include('config.php');

$name = $_POST['name'];
$email = $_POST['email'];
$doctor_id = $_POST['doctor_id'];
$date = $_POST['appointment_date'];
$time = $_POST['appointment_time'];

$stmt = $conn->prepare("INSERT INTO appointments (name, email, doctor_id, appointment_date, appointment_time)
VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssiss", $name, $email, $doctor_id, $date, $time);

if ($stmt->execute()) {
    echo "Appointment booked successfully!";
} else {
    echo "Error: " . $stmt->error;
}
?>
