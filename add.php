<?php
$user = 'root';
$pass = 'root';
header('Content-Type: application/json');
$pdo = new PDO('mysql:host=127.0.0.1;port=8889;dbname=bse', $user, $pass);
// Read JSON Body of request
$data = json_decode(file_get_contents('php://input'), true);
$text = trim($data['text'] ?? '');
if(strlen($text) == 0) {
echo json_encode(["ok" => false]);
} else {
$statement = $pdo->prepare("INSERT INTO todo (text) VALUES (?)");
$ok = $statement->execute([$text]);
echo json_encode(["ok" => $ok]);
}
?>