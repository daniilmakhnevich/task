<?php
include "CRUD.php";

switch ($_POST['func']) {
    case 'check':
        check();
        break;
    case 'logout':
        logout();
        break;
    }

function check(){
    $login = $_POST['login'];
    $password = cryptPassword($_POST['password']);
    $data=file_get_contents('../../json/Jsondb.json');;
    $data=json_decode($data, true);
    foreach($data as $usr){
        if(strcmp($usr['login'], $login) == 0){
            if(strcmp($usr['password'], $password) == 0){
                session_start();
                $_SESSION['login'] = $login;
                return;
            }
        }
    }
    echo json_encode(array('Неверный логин или пароль'), JSON_UNESCAPED_UNICODE);
}

function logout(){
    session_start();
    unset($_SESSION['login']);
}
?>