 <?php 
$user = "root";
$pass = 'root';
$pdo = new PDO('mysql:host=127.0.0.1;port=8889;dbname=scooterhub', $user, $pass);
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$Nutzername = trim($data['nutzer'] ?? '');
$Matrikelnr = trim($data['pw'] ?? '');

if(strlen($Nutzername) == 0 || strlen($Matrikelnr) == 0 ) {
    echo json_encode(["ok" => false]);
    } else {
    $statement = $pdo->prepare("SELECT Nutzername, Matrikelnr FROM Nutzer WHERE Matrikelnr = ? AND Nutzername = ? ");
    $ok = $statement->execute(array($Matrikelnr, $Nutzername));
    $respone = $statement->fetchAll(PDO::FETCH_ASSOC);

    if($respone[0]['Nutzername'] != $Nutzername || $respone[0]['Matrikelnr'] != $Matrikelnr){
       // http_response_code(500);
        echo json_encode(["ok" => false]);
    }else{
       // http_response_code(200);
        echo json_encode(["ok" => true]);
    }
}

    
