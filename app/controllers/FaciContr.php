<?php
namespace controllers;

use models\Facility;

class FaciContr extends Facility{

    public function fetchFaci()
    {
        return $this->getFacility();
    }

    public function setFacilities(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $equipmentType = $_POST['equipment_type'];
            $description = $_POST['description'];
            $status = $_POST['status'];
        
            $this->insertFacility($equipmentType, $description, $status);
        }
    }

    public function delete($id){

        $facilityId = $_GET['id'];

        $this->delFaci($id);
    }

    public function getId(){
        $id = $_GET['id'];
        return $this->getFaciId($id);
    }

    public function upFacility(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $facilityId = $_GET['id'];
            $equipmentType = $_POST['equipment_type'];
            $description = $_POST['description'];
            $status = $_POST['status'];
        
            $this->setFacility($equipmentType, $description, $status, $facilityId);
        }
    }
}