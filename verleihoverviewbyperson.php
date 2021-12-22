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
$data = json_decode(file_get_contents('php://input'), true);
$userid = trim($data['id'] ?? '');
if(strlen($userid) == 0) {
    echo json_encode(["ok" => false]);
    } else {
$statement = $pdo->prepare("SELECT * FROM reservation where user_id = ?");
$statement->execute([$userid]);
$data = $statement->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);}
?>
