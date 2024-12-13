<?php
namespace models;

use config\Db;

class Rooms extends Db{

    public function getRooms(){
        $stmt = $this->connect()->query("SELECT * FROM rooms");
        $stmt->execute();
        $rooms = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt = null;
        return $rooms;
    }
    public function fetchRoom($id){
        $roomStmt = $this->connect()->prepare("SELECT * FROM rooms WHERE id = :id");
        $roomStmt->execute([':id' => $id]);
        return $room = $roomStmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function insRoom($roomNum, $roomType, $tSlots){

        $stmt = $this->connect()->prepare("INSERT INTO rooms (room_number, room_type, total_slots) VALUES (:room_number, :room_type, :total_slots)");
        $stmt->execute([
            ':room_number' => $roomNum,
            ':room_type' => $roomType,
            ':total_slots' => $tSlots
        ]);

    }

    public function getRoomId($id){

        $stmt = $this->connect()->prepare("SELECT * FROM rooms WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $room = $stmt->fetch(\PDO::FETCH_ASSOC);     
    }

    public function setRoom($roomNum, $roomType, $tSlots, $rSlots, $id){

        $stmt = $this->connect()->prepare("UPDATE rooms SET room_number = :room_number, room_type = :room_type, total_slots = :total_slots, remaining_slots = :remaining_slots WHERE id = :id");
        $stmt->execute([
            ':room_number' => $roomNum,
            ':room_type' => $roomType,
            ':total_slots' => $tSlots,
            ':remaining_slots' => $rSlots,
            ':id' => $id
        ]);
    }

    public function delete($id){
    $stmt = $this->connect()->prepare("DELETE FROM rooms WHERE id = :id");
    $stmt->execute([':id' => $id]);
    }
    
    public function availRoom(){
        $query = "SELECT * FROM rooms WHERE remaining_slots > 0";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $rooms = $stmt->fetchAll();
    }
}