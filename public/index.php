<?php

use controllers\FaciContr;
use controllers\RoomsContr;
use controllers\TenantsContr;

require_once '../app/autoload.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $action = $_POST['action'];

    if($action === 'login'){
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        $loginController = new controllers\LoginContr($username, $password);
        $error = $loginController->login(); 
    }elseif($action === 'signUp'){
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        $loginController = new controllers\LoginContr($username, $password);
        $error = $loginController->signUp(); 
    }elseif($action === 'up_room'){
        $roomContr = new RoomsContr();
        $roomContr->editRoom();

        header('Location: /JJF/app/views/user/home.php');
        exit();
    }elseif($action === 'add_room'){
        $roomContr = new RoomsContr();
        $roomContr->addRoom();

        header('Location: /JJF/app/views/user/home.php');
        exit();
    }elseif($action === 'add_tenant'){
        $tenantContr = new TenantsContr();
        $tenantContr->addTenant();

        header('Location: /JJF/app/views/user/newTenants.php');
        exit();
    }elseif($action === 'edit_tenant'){
        $tenantContr = new TenantsContr();
        $tenantContr->upTenant();

        header('Location: /JJF/app/views/user/newTenants.php');
        exit();
        $tenantContr =  new TenantsContr();
        $tenantContr->assign();
    }elseif($action === 'assign_tenant'){
        $tenantContr =  new TenantsContr();
        $tenantContr->assign();

        header('Location: /JJF/app/views/user/newTenants.php');
        exit;
    }
    elseif($action === 'change_room'){
        $tenantContr =  new TenantsContr();
        $tenantContr->changeTenantRoom();

        header('Location: /JJF/app/views/user/tenants.php');
        exit;
    }
    elseif($action === 'add_faci'){
        $faciContr = new FaciContr();
        $faciContr->setFacilities();

        header('Location: /JJF/app/views/user/facility.php');
        exit();
    }elseif($action === 'edit_faci'){
        $faciContr = new FaciContr();
        $faciContr->upFacility();

        header('Location: /JJF/app/views/user/facility.php');
        exit();
    }
    
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $action = $_GET['action'] ?? '';
    $id = $_GET['id'] ?? '';

    if($action === 'edit_room'){
        $roomContr =  new RoomsContr();
        $roomContr->getId();
        header("Location: /JJF/app/views/edit/roomEdit.php?id=$id");
    }elseif($action ==='del_room'){
        $roomContr =  new RoomsContr();
        $roomContr->delRoom($id);
        header("Location: /JJF/app/views/user/home.php");
    }elseif($action ==='manage_room'){
        $roomContr =  new RoomsContr();
        $roomContr->findRoom();
        header("Location: /JJF/app/views/manage/manageRoom.php?id=$id");
    }elseif($action ==='checkOut_tenant'){
        $tenantContr =  new TenantsContr();
        $tenantContr->checkOUtTenant();
        header("Location: /JJF/app/views/user/home.php?id=$id");
    }elseif($action ==='del_tenant'){
        $tenantContr =  new TenantsContr();
        $tenantContr->delete($id);
        header("Location: /JJF/app/views/user/newTenants.php?id=$id");
    }elseif($action ==='edit_tenant'){
        $tenantContr =  new TenantsContr();
        $tenantContr->getId();
        header("Location: /JJF/app/views/edit/tenantEdit.php?id=$id");
    }elseif($action ==='assign_tenant'){
        header("Location: /JJF/app/views/assign/assignTenant.php?id=$id");
    }elseif($action ==='change_room'){
        header("Location: /JJF/app/views/edit/changeRoom.php?id=$id");
    }elseif($action === 'del_faci'){
        $faciContr = new FaciContr();
        $faciContr->delete($id);
        header("Location: /JJF/app/views/user/facility.php?id=$id");
        exit();
    }elseif($action === 'edit_faci'){
        $faciContr = new FaciContr();
        $faciContr->getId();
        header("Location: /JJF/app/views/edit/facilityEdit.php?id=$id");
        exit();
    }

}

require_once '../app/views/user/login.php';