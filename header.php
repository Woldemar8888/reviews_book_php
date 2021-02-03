<?php
    require_once 'User.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Страница отзывов</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/pagination.js" defer></script>
    
</head>
<body>
    <header>
        <nav>
            <ul>
                <?php
                    if(isset($_SESSION['user'])){
                        $user = $_SESSION['user'];
                        echo '<li><a href="logoutHandler.php">Выйти</a></li>';
                        echo '<li class="hello">Привет <a href="profile.php">'.$user->getName().'</a></li>';
                        
                    }else{
                        echo '<li><a href="register.php">Регистрация</a></li>';
                        echo '<li><a href="login.php">Войти</a></li>'; 
                    }
                ?>                
            </ul>
        </nav>
    </header>
<div class="container">