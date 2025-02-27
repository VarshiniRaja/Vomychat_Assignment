<?php
require_once '../config/database.php';
require_once '../middleware/auth.php';

$user_id = get_authenticated_user_id();
$stmt = $conn->prepare("SELECT COUNT(*) as referral_count FROM referrals WHERE referrer_id = ?");
$stmt->execute([$user_id]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode(["referral_count" => $result['referral_count']]);
?>
