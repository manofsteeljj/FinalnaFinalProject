<?php
namespace models;

use config\Db;

class Tenants extends Db{

    public function getTenants(){
        $stmt = $this->connect()->query("SELECT * FROM tenants");
        $stmt->execute();
        $tenants = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt = null;
        return $tenants;
    }
    
    public function fetchTenant($tenantId){
        // Fetch tenant details
        $query = "SELECT * FROM tenants WHERE id = :tenant_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(['tenant_id' => $tenantId]);
        return $tenant = $stmt->fetch();
    }

    public function findTenant($id){
        $tenantStmt = $this->connect()->prepare("SELECT * FROM tenants WHERE room_id = :room_id");
        $tenantStmt->execute([':room_id' => $id]);
        return $tenants = $tenantStmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function checkOut($id){
        $query = "SELECT room_id FROM tenants WHERE id = :tenant_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(['tenant_id' => $id]);
        $tenant = $stmt->fetch();

        if ($tenant && $tenant['room_id']) {
            $query = "UPDATE rooms SET remaining_slots = remaining_slots + 1 WHERE id = :room_id";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(['room_id' => $tenant['room_id']]);
        }

        $query = "UPDATE tenants SET room_id = NULL, stay_from = NULL, stay_to = NULL WHERE id = :tenant_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(['tenant_id' => $id]);
    }

    public function setTenant($fullName, $gender, $mobileNumber){
        $query = "INSERT INTO tenants (full_name, gender, mobile_number) VALUES (:full_name, :gender, :mobile_number)";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([
            'full_name' => $fullName,
            'gender' => $gender,
            'mobile_number' => $mobileNumber
        ]);
    }

    public function delete($id){
        // Fetch the room ID of the tenant to update room slots
        $query = "SELECT room_id FROM tenants WHERE id = :tenant_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(['tenant_id' => $id]);
        $tenant = $stmt->fetch();

        // Update the remaining slots for the room
        if ($tenant && $tenant['room_id']) {
            $query = "UPDATE rooms SET remaining_slots = remaining_slots + 1 WHERE id = :room_id";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(['room_id' => $tenant['room_id']]);
        }

        // Delete the tenant record
        $query = "DELETE FROM tenants WHERE id = :tenant_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(['tenant_id' => $id]);

    }

    public function getTenantId($id){
        $query = "SELECT * FROM tenants WHERE id = :tenant_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(['tenant_id' => $id]);
        return $tenant = $stmt->fetch();
    }

    public function editTenant($fullName, $gender, $mobileNumber, $tenantId){
        $query = "UPDATE tenants SET full_name = :full_name, gender = :gender, mobile_number = :mobile_number WHERE id = :tenant_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([
            'full_name' => $fullName,
            'gender' => $gender,
            'mobile_number' => $mobileNumber,
            'tenant_id' => $tenantId
        ]);
    }

    public function assignTenant($roomId, $stayFrom, $stayTo, $tenantId){
        $query = "UPDATE tenants SET room_id = :room_id, stay_from = :stay_from, stay_to = :stay_to WHERE id = :tenant_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([
            'room_id' => $roomId,
            'stay_from' => $stayFrom,
            'stay_to' => $stayTo,
            'tenant_id' => $tenantId
        ]);

        // Update the remaining slots for the room
        $query = "UPDATE rooms SET remaining_slots = remaining_slots - 1 WHERE id = :room_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(['room_id' => $roomId]);
    }

    public function changeRoom($roomId, $stayFrom, $stayTo, $tenantId){

        $query = "SELECT * FROM tenants WHERE id = :tenant_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(['tenant_id' => $tenantId]);
        $tenant = $stmt->fetch();

        // Update the tenant's room and stay dates
        $query = "UPDATE tenants SET room_id = :room_id, stay_from = :stay_from, stay_to = :stay_to WHERE id = :tenant_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([
            'room_id' => $roomId,
            'stay_from' => $stayFrom,
            'stay_to' => $stayTo,
            'tenant_id' => $tenantId
        ]);

        // Update the remaining slots for the old room
        $query = "UPDATE rooms SET remaining_slots = remaining_slots + 1 WHERE id = :room_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(['room_id' => $tenant['room_id']]);

        // Update the remaining slots for the new room
        $query = "UPDATE rooms SET remaining_slots = remaining_slots - 1 WHERE id = :room_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(['room_id' => $roomId]);
    }

    public function assignedTenant(){
        $query = "SELECT t.id, t.full_name, t.gender, t.mobile_number, t.stay_from, t.stay_to, t.room_id, r.room_number, r.room_type 
          FROM tenants t
          LEFT JOIN rooms r ON t.room_id = r.id";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $tenants = $stmt->fetchAll();
    }
}