<?php
$user = 'root';
$pass = 'root';
header('Content-Type: application/json');
$pdo = new PDO('mysql:host=127.0.0.1;port=8889;dbname=scooterhub', $user, $pass);
// Read JSON Body of request
$data = json_decode(file_get_contents('php://input'), true);
$id = trim($data['id'] ?? '');
if(strlen($id) == 0) {
echo json_encode(["ok" => false, 'id' => $id]);
} else {
$statement = $pdo->prepare("Delete FROM Scooter WHERE ScooterId = (?)");
$ok = $statement->execute([$id]);
echo json_encode(["ok" => $ok]);
}
?>