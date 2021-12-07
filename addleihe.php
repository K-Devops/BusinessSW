<?php
$user = 'root';
$pass = 'root';
header('Content-Type: application/json');
$pdo = new PDO('mysql:host=127.0.0.1;port=8889;dbname=scooterhub', $user, $pass);
// Read JSON Body of request
$data = json_decode(file_get_contents('php://input'), true);
$sid = trim($data['scooterid'] ?? '');
$uid = trim($data['userid'] ?? '');
$enddate = trim($data['enddate'] ?? '');
/*if(strlen($enddate) == 0) {
echo json_encode(["ok" => false]);
} else */{
$statement = $pdo->prepare("INSERT INTO Verleih (Scooter_Id, User_Id, 'Enddate') VALUES (':ScooterId', ':User_Id', ':Enddate')");
$ok = $statement->execute(array(':ScooterId'=> $sid , ':User_Id'=> $uid, ':Enddate'=> $enddate));
echo json_encode(["ok" => $ok]);
}
?>