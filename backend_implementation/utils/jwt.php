<?php
require_once '../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$secretKey = "your_secret_key";


if (!function_exists('generate_jwt')) {
    function generate_jwt($payload) {
        global $secretKey;
        return \Firebase\JWT\JWT::encode($payload, $secretKey, 'HS256');
    }
}
function verifyJWT($token) {
    global $secretKey;
    try {
        $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
        return (array) $decoded;
    } catch (Exception $e) {
        return null;
    }
}

function get_authenticated_user_id() {
    $headers = getallheaders();
    
    if (!isset($headers['Authorization'])) {
        die(json_encode(["error" => "Authorization header missing"]));
    }

    $authHeader = $headers['Authorization'];
    $token = str_replace('Bearer ', '', $authHeader);

    $userData = verifyJWT($token);
    
    if (!$userData) {
        die(json_encode(["error" => "Invalid or expired token"]));
    }

    return isset($userData['id']) ? (int) $userData['id'] : null;
}
?>
