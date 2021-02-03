<?php
require_once 'connection.php';
require_once 'User.php';
session_start();

$login = trim($_POST['login']);
$password = trim($_POST['password']);
$user;

$stmt = $pdo->prepare("SELECT * FROM users WHERE LOGIN=:LOGIN");
$stmt->execute(['LOGIN' => $login]);

$data = [];

if($stmt){
    
    $arr = $stmt->fetch();
    if($arr['PASSWORD'] == $password){
        $id = $arr['USER_ID'];
        $role_id = $arr['ROLE_ID'];
        $name = $arr['NAME'];
        $phone = $arr['PHONE'];
        $email = $arr['EMAIL'];
        
        $user = new User($name, $phone, $email);
        $user->setId($id);
        $user->setRoleId($role_id);
        $_SESSION['user'] = $user;
    } 
}

echo '<script>location.replace("/");</script>'; exit;
