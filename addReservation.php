<?php

$user = 'root';

$pass = 'root';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$pdo = new PDO('mysql:host=127.0.0.1;port=8889;dbname=scooterreservation', $user, $pass);

// Read JSON Body of request

$data = json_decode(file_get_contents('php://input'), true);

$sid = trim($data['scooterid'] ?? '');

$uid = trim($data['userid'] ?? '');


if(strlen($sid) == 0||strlen($uid) == 0) {
    echo json_encode(["ok" => false]);
    } else {

$statement = $pdo->prepare("INSERT INTO reservation (SCOOTER_ID, USER_ID) VALUES (?,?)");
$ok = $statement->execute([$sid,$uid]);
$statement2 = $pdo->prepare("UPDATE SCOOTER SET RESERVATION_STATUS = 'reserviert' where SCOOTER_ID =(?)");
$ok2 = $statement2->execute([$sid]);

echo json_encode(["insert" => $ok, "update" => $ok2]);

}

?>