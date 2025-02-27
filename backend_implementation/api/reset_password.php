<?php
require_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));
$token = $data->token;
$new_password = password_hash($data->new_password, PASSWORD_BCRYPT);

$stmt = $conn->prepare("UPDATE users SET password_hash = ?, reset_token = NULL WHERE reset_token = ?");
$stmt->execute([$new_password, $token]);

echo json_encode(["message" => "Password reset successfully"]);
?>
