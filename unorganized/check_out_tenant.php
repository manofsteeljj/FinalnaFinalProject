<?php
require_once('db.php');

$tenantId = $_GET['id'];

$query = "SELECT room_id FROM tenants WHERE id = :tenant_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['tenant_id' => $tenantId]);
$tenant = $stmt->fetch();

if ($tenant && $tenant['room_id']) {
    $query = "UPDATE rooms SET remaining_slots = remaining_slots + 1 WHERE id = :room_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['room_id' => $tenant['room_id']]);
}

$query = "UPDATE tenants SET room_id = NULL, stay_from = NULL, stay_to = NULL WHERE id = :tenant_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['tenant_id' => $tenantId]);

header("Location: manage_tenants.php");
exit;
?>
