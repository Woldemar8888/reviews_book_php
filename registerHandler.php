<?php
require_once 'connection.php';
require_once 'User.php';
session_start();
$name = trim($_POST['name']);
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);
$login = trim($_POST['login']);
$password = trim($_POST['password']);
$duplicatePassword = trim($_POST['dpassword']);
$user;

function validate(){
    global $name, $phone, $email, $login, $password, $duplicatePassword ;
    
    if(strlen($name) < 2){
        echo 'name not valid';
       return false; 
    } 
    if(strlen($phone) != 13){
        echo 'phone not valid';
        return false;
    } 
    if(strlen($login) < 2){
        echo 'login not valid';
       return false; 
    } 
    if(strlen($password) < 2){
        echo 'password not valid';
        return false;
    }
    if($password != $duplicatePassword){
        return false;
    }
    return true;
}


if(validate()){
   $stmt = $pdo->prepare("INSERT INTO users(NAME, PHONE, EMAIL, LOGIN, PASSWORD) VALUES( :name, :phone, :email , :login, :password)");
    $result = $stmt->execute(['name'=>$name, 'phone'=>$phone, 'email'=>$email, 'login'=>$login, 'password' =>$password ]);
    if($result){
        echo 'Данные успешно сохранены<br>';
        $st = $pdo->prepare("SELECT USER_ID, ROLE_ID FROM users WHERE LOGIN=:LOGIN");
        $st->execute(['LOGIN' => $login]);
        $arr = $st->fetch();
        $id = $arr['USER_ID'];
        $role_id = $arr['ROLE_ID'];
        $user = new User($name, $phone, $email);
        $user->setId($id);
        $user->setRoleId($role_id);
        var_dump($user->getId());
        var_dump($user->getRoleId());
        $_SESSION['user'] = $user;
        echo '<script>location.replace("/");</script>'; exit;
        
    }else{
        echo 'Такой логин уже существует' ;
    } 
}else{
echo 'data not valid';}
