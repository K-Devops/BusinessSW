 <?php 
$user = "root";
$pass = 'root';
$pdo = new PDO('mysql:host=127.0.0.1;port=8889;dbname=scooterreservation', $user, $pass);
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}


$data = json_decode(file_get_contents('php://input'), true);

$name = trim($data['name'] ?? '');
$password = trim($data['password'] ?? '');

if(strlen($name) == 0 || strlen($password) == 0 ) {
    echo json_encode(["ok" => false ]);
    } else {
    $statement = $pdo->prepare("SELECT * FROM USER WHERE PASSWORD = ? AND NAME = ? ");
    $ok = $statement->execute(array($password, $name));
    $respone = $statement->fetchAll(PDO::FETCH_ASSOC);

    if($respone[0]['NAME'] != $name || $respone[0]['PASSWORD'] != $password){
       // http_response_code(500);
        echo json_encode(["ok" => $respone]);
    }else{
       // http_response_code(200);
        echo json_encode(["ok" => true]);
    }
}

    
