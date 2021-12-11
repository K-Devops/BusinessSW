<?php
$user = 'root';
$pass = 'root';
header('Content-Type: application/json');
$pdo = new PDO('mysql:host=127.0.0.1;port=8889;dbname=scooterhub', $user, $pass);
$data = json_decode(file_get_contents('php://input'), true);
$userid = trim($data['id'] ?? '');
if(strlen($userid) == 0) {
    echo json_encode(["ok" => false]);
    } else {
$statement = $pdo->prepare("SELECT * FROM Verleih where user_id = ?");
$statement->execute([$userid]);
$data = $statement->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);}
?>
