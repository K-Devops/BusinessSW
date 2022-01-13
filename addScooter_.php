<?php
$user = 'root';
$pass = 'root';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

$pdo = new PDO('mysql:host=127.0.0.1;port=8889;dbname=scooterreservation', $user, $pass);
// Read JSON Body of request
$data = json_decode(file_get_contents('php://input'), true);
$reservation_status = trim($data['reservation_status'] ?? '');
if(strlen($reservation_status) == 0) {
echo json_encode(["ok" => false]);
} else {
$statement = $pdo->prepare("INSERT INTO Scooter (RESERVATION_STATUS) VALUES (?)");
$ok = $statement->execute([$reservation_status]);
echo json_encode(["ok" => $ok]);
}
?>