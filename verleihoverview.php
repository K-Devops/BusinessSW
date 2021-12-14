<?php
$user = 'root';
$pass = 'root';
header('Content-Type: application/json');
$pdo = new PDO('mysql:host=127.0.0.1;port=8889;dbname=scooterreservation', $user, $pass);
$statement = $pdo->prepare("SELECT * FROM reservation");
$statement->execute();
$data = $statement->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
?>
