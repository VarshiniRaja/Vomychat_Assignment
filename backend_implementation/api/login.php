<?php
require_once '../config/database.php';
require_once '../utils/jwt.php';

$data = json_decode(file_get_contents("php://input"));
$email = $data->email;
$password = $data->password;

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user['password_hash'])) {
    die(json_encode(["error" => "Invalid credentials"]));
}

$token = generate_jwt(["id" => $user['id'], "email" => $user['email']]);
echo json_encode(["token" => $token]);
?>
