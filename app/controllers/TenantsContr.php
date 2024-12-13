<?php
namespace controllers;

use models\Tenants;

class TenantsContr extends Tenants{

    public function fetchTenants()
    {
        return $this->getTenants();
    }

    public function getTenant() {
        $id = $_GET['id'];
        return $this->findTenant($id);
    }

    public function checkOUtTenant(){
        $id = $_GET['id'];
        return $this->checkOut($id);
    }

    public function addTenant(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullName = $_POST['full_name'];
            $gender = $_POST['gender'];
            $mobileNumber = $_POST['mobile_number'];
        
            $this->setTenant($fullName, $gender, $mobileNumber);
        }
    }

    public function delTenant($id){
        $this->delete($id);
    }

    public function getId(){
        $id = $_GET['id'];
        return $this->getTenantId($id);
    }
    
    public function upTenant(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_GET['id'];
            $fullName = $_POST['full_name'];
            $gender = $_POST['gender'];
            $mobileNumber = $_POST['mobile_number'];
        
            $this->editTenant($fullName, $gender, $mobileNumber, $id);
        }
    }
    public function assign(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_GET['id'];
            $roomId = $_POST['room_id'];
            $stayFrom = $_POST['stay_from'];
            $stayTo = $_POST['stay_to'];
        
            $this->assignTenant($roomId, $stayFrom, $stayTo, $id);
        }
    }
    public function assigned(){
        return $this->assignedTenant();
    }
    public function changeTenantRoom(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_GET['id'];
            $roomId = $_POST['room_id'];
            $stayFrom = $_POST['stay_from'];
            $stayTo = $_POST['stay_to'];
        
            $this->changeRoom($roomId, $stayFrom, $stayTo, $id);
        }
    }
}