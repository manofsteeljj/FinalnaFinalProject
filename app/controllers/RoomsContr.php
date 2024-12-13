<?php
namespace controllers;

use models\Rooms;

class RoomsContr extends Rooms{

    public function fetchRooms()
    {
        return $this->getRooms();
    }
    public function getId(){
        $id = $_GET['id'];
        return $this->getRoomId($id);
    }
    public function findRoom(){
        $id = $_GET['id'];
        return $this->fetchRoom($id);
    }
    public function addRoom(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $room_number = $_POST['room_number'];
            $room_type = $_POST['room_type'];
            $total_slots = (int) $_POST['total_slots'];
            
            $this->insRoom($room_number, $room_type, $total_slots);
            
        }
    }
    public function editRoom(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_GET['id'];
            $room_number = $_POST['room_number'];
            $room_type = $_POST['room_type'];
            $total_slots = (int) $_POST['total_slots'];
            $remaining_slots = $_POST['remaining_slots'];
            
            $this->setRoom($room_number, $room_type, $total_slots, $remaining_slots, $id);
            
        }
    }
    public function delRoom($id){
        $this->delete($id);
    }
    public function availRooms(){
        return $this->availRoom();
    }
}