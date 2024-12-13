<?php
namespace models;

use config\Db;

class Facility extends Db{

    public function getFacility(){
        $stmt = $this->connect()->query("SELECT * FROM facilities");
        $stmt->execute();
        $faci = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt = null;
        return $faci;
    }

    public function insertFacility($equipmentType, $description, $status){
        $query = "INSERT INTO facilities (equipment_type, description, status) VALUES (:equipment_type, :description, :status)";
        $stmt =  $this->connect()->prepare($query);
        $stmt->execute([
            'equipment_type' => $equipmentType,
            'description' => $description,
            'status' => $status
    ]);
    }

    public function delFaci($id){
        $query = "DELETE FROM facilities WHERE id = :facility_id";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(['facility_id' => $id]);
    }

    public function getFaciId($facilityId){
        $query = "SELECT * FROM facilities WHERE id = :facility_id";
        $stmt =  $this->connect()->prepare($query);
        $stmt->execute(['facility_id' => $facilityId]);
        return $facility = $stmt->fetch();
    }

    public function setFacility($equipmentType, $description, $status, $facilityId){
            $query = "UPDATE facilities SET equipment_type = :equipment_type, description = :description, status = :status WHERE id = :facility_id";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([
                'equipment_type' => $equipmentType,
                'description' => $description,
                'status' => $status,
                'facility_id' => $facilityId
            ]);
    }
}