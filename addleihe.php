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
$sid = trim($data['scooterid'] ?? '');
$uid = trim($data['userid'] ?? '');
$enddate = trim($data['enddate'] ?? '');
/*if(strlen($enddate) == 0) {
echo json_encode(["ok" => false]);
} else */{
$statement = $pdo->prepare("INSERT INTO reservation (Scooter_Id, User_Id, 'Enddate') VALUES (':ScooterId', ':User_Id', ':Enddate')");
$ok = $statement->execute(array(':ScooterId'=> $sid , ':User_Id'=> $uid, ':Enddate'=> $enddate));
echo json_encode(["ok" => $ok]);
}
?>