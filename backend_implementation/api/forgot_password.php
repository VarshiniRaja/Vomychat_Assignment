<?php
require_once '../config/database.php';
require_once '../utils/mailer.php';

$data = json_decode(file_get_contents("php://input"));
$email = $data->email;

$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) die(json_encode(["error" => "Email not found"]));

$token = bin2hex(random_bytes(32));
$stmt = $conn->prepare("UPDATE users SET reset_token = ? WHERE id = ?");
$stmt->execute([$token, $user['id']]);

send_email($email, "Reset Your Password", "Click here: https://yourdomain.com/reset?token=$token");

echo json_encode(["message" => "Password reset link sent"]);
?>
