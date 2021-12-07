<?php
$user = 'root';
$pass = 'root';
header('Content-Type: application/json');
$pdo = new PDO('mysql:host=127.0.0.1;port=8889;dbname=scooterhub', $user, $pass);
// Read JSON Body of request
$data = json_decode(file_get_contents('php://input'), true);
$Status = trim($data['status'] ?? '');
$id = trim($data['id'] ?? '');
// Null prüfung fehlt an dieser Stelle noch
{
$statement = $pdo->prepare('UPDATE Scooter SET leihstatus = :leihstatus where ScooterId = :ScooterId');
$ok = $statement->execute(array(':leihstatus' => $Status, ':ScooterId' => $id));
echo json_encode(["ok" => $ok]);
}
?>