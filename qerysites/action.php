<?php
require_once 'DB.php';
$db = new DB();
$tblName = 'users';
if(isset($_REQUEST['type']) && !empty($_REQUEST['type'])){
    $type = $_REQUEST['type'];
    switch($type){
        case "view":
            $records = $db->getRows($tblName);
            if($records){
                
                $data['records'] = $db->getRows($tblName);
                $data['status'] = 'OK';
            }else{
                $data['records'] = array();
                $data['status'] = 'ERR';
            }
            echo json_encode($data);
            break;
        case "add":
            if(!empty($_POST['data'])){
                $userData = array(
                    'idlevel' => $_POST['data']['idlevel'],
                    'name' => $_POST['data']['name'],
                    'uid' => $_POST['data']['uid'],
                    'email' => $_POST['data']['email'],
                    'phone' => $_POST['data']['phone']
                );
                $insert = $db->insert($tblName,$userData);
                if($insert){
                    $data['data'] = $insert;
                    $data['status'] = 'OK';
                    $data['msg'] = 'Інформація про клієнта зареєстрована.';
                }else{
                    $data['status'] = 'ERR';
                    $data['msg'] = 'Помилка роботи. Повторіть спробу.';
                }
            }else{
                $data['status'] = 'ERR';
                $data['msg'] = 'Помилка роботи. Повторіть спробу.';
            }
            echo json_encode($data);
            break;
        case "edit":
            if(!empty($_POST['data'])){
                $userData = array(
                    'idlevel' => $_POST['data']['idlevel'],
                    'name' => $_POST['data']['name'],
                    'uid' => $_POST['data']['uid'],
                    'email' => $_POST['data']['email'],
                    'phone' => $_POST['data']['phone']
                );
                $condition = array('id' => $_POST['data']['id']);
                $update = $db->update($tblName,$userData,$condition);
                if($update){
                    $data['status'] = 'OK';
                    $data['msg'] = 'Інформація про клієнта була змінена.';
                }else{
                    $data['status'] = 'ERR';
                    $data['msg'] = 'Помилка роботи. Повторіть спробу.';
                }
            }else{
                $data['status'] = 'ERR';
                $data['msg'] = 'Помилка роботи. Повторіть спробу.';
            }
            echo json_encode($data);
            break;
        case "delete":
            if(!empty($_POST['id'])){
                $condition = array('id' => $_POST['id']);
                $delete = $db->delete($tblName,$condition);
                if($delete){
                    $data['status'] = 'OK';
                    $data['msg'] = 'Інформація про клієнта видалена.';
                }else{
                    $data['status'] = 'ERR';
                    $data['msg'] = 'Видалити не вдалося. Повторіть спробу.';
                }
            }else{
                $data['status'] = 'ERR';
                $data['msg'] = 'Помилка роботи. Повторіть спробу.';
            }
            echo json_encode($data);
            break;
        default:
            echo '{"status":"По замовченню"}';
    }
}
