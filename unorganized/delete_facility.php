<?php
require_once('db.php');

// Get facility ID from URL
$facilityId = $_GET['id'];

// Delete the facility from the database
$query = "DELETE FROM facilities WHERE id = :facility_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['facility_id' => $facilityId]);

// Redirect back to the manage facilities page after deleting the facility
header("Location: manage_facilities.php");
exit;
?>
