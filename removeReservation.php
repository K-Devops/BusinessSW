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
$sid = trim($data['scooterid'] ?? '');
$rid = trim($data['reservationid'] ?? '');
if(strlen($sid) == 0) {
echo json_encode(["ok" => false]);
} else {
$statement1 = $pdo->prepare("SELECT STARTDATE FROM reservation where RESERVATION_ID =(?)");
$ok1 = $statement1->execute([$rid]);
$response = $statement1->fetchAll(PDO::FETCH_ASSOC);

$statement2 = $pdo->prepare("UPDATE Scooter SET RESERVATION_STATUS = 'Frei' where SCOOTER_ID =(?)");
$ok2 = $statement2->execute([$sid]);

$statement3 = $pdo->prepare("UPDATE reservation SET ENDDATE = now(), STARTDATE = (?) where RESERVATION_ID =(?)");
$ok3 = $statement3->execute([$response[0]['STARTDATE'],$rid]);



echo json_encode(["Update3" => $ok3, "Update2" => $ok2, "Update1" => $ok1]);
}

?>