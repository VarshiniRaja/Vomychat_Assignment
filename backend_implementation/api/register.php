<?php
require_once '../config/database.php';
require_once '../utils/jwt.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->username, $data->email, $data->password)) {
    die(json_encode(["error" => "Missing required fields"]));
}

$username = $data->username;
$email = $data->email;
$password = password_hash($data->password, PASSWORD_BCRYPT);
$referral_code = uniqid();
$referred_by = isset($data->referral_code) ? $data->referral_code : NULL;

// Insert user
$sql = "INSERT INTO users (username, email, password_hash, referral_code, referred_by) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$username, $email, $password, $referral_code, $referred_by]);

// Track referral if applicable
if ($referred_by) {
    $referrer_id = $conn->prepare("SELECT id FROM users WHERE referral_code = ?");
    $referrer_id->execute([$referred_by]);
    $referrer_id = $referrer_id->fetchColumn();

    if ($referrer_id) {
        $sql = "INSERT INTO referrals (referrer_id, referred_user_id, status) VALUES (?, LAST_INSERT_ID(), 'pending')";
        $conn->prepare($sql)->execute([$referrer_id]);
    }
}

echo json_encode(["message" => "User registered successfully"]);
?>
