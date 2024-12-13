<?php
require_once('db.php');

// Get tenant ID from URL
$tenantId = $_GET['id'];

// Fetch the room ID of the tenant to update room slots
$query = "SELECT room_id FROM tenants WHERE id = :tenant_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['tenant_id' => $tenantId]);
$tenant = $stmt->fetch();

// Update the remaining slots for the room
if ($tenant && $tenant['room_id']) {
    $query = "UPDATE rooms SET remaining_slots = remaining_slots + 1 WHERE id = :room_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['room_id' => $tenant['room_id']]);
}

// Delete the tenant record
$query = "DELETE FROM tenants WHERE id = :tenant_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['tenant_id' => $tenantId]);

// Redirect to the manage new tenant page after deletion
header("Location: manage_new_tenant.php");
exit;
?>
