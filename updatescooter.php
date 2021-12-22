<?php
$user = 'root';
$pass = 'root';
header('Content-Type: application/json');
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
$Status = trim($data['status'] ?? '');
$id = trim($data['id'] ?? '');
// Null prüfung fehlt an dieser Stelle noch
{
$statement = $pdo->prepare('UPDATE scooter SET reservation_status = :reservation_status where Scooter_ID = :Scooter_ID');
$ok = $statement->execute(array(':reservation_status' => $Status, ':Scooter_ID' => $id));
echo json_encode(["ok" => $ok]);
}
?>  