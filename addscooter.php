<?php
$user = 'root';
$pass = 'root';
header('Content-Type: application/json');
$pdo = new PDO('mysql:host=127.0.0.1;port=8889;dbname=scooterhub', $user, $pass);
// Read JSON Body of request
$data = json_decode(file_get_contents('php://input'), true);
$leihstatus = trim($data['leihstatus'] ?? '');
if(strlen($leihstatus) == 0) {
echo json_encode(["ok" => false]);
} else {
$statement = $pdo->prepare("INSERT INTO Scooter (leihstatus) VALUES (?)");
$ok = $statement->execute([$leihstatus]);
echo json_encode(["ok" => $ok]);
}
?>