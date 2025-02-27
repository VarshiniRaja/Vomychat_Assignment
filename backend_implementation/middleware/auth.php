<?php
require_once '../vendor/autoload.php';
require_once '../utils/jwt.php'; // ✅ Include jwt.php instead of redefining functions

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$jwt_secret = "your_secret_key"; // Use the same secret key from jwt.php

function authenticate() {
    if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
        http_response_code(401);
        echo json_encode(["error" => "Unauthorized: Missing token"]);
        exit();
    }

    $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
    $token = str_replace("Bearer ", "", $authHeader);
    
    $decodedToken = verifyJWT($token);
    if (!$decodedToken) {
        http_response_code(401);
        echo json_encode(["error" => "Unauthorized: Invalid token"]);
        exit();
    }

    return $decodedToken;
}

?>
