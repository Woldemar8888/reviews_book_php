<?php
require_once 'connection.php';

$id = trim($_POST['id']);
$title = trim($_POST['title']);
$message = trim($_POST['message']);

function validate(){
    global $id, $title, $message;
    if($id==NULL){
        return false;
    }
    if(strlen($title) < 2 ){
        return false;
    }
    if(strlen($message) < 2){
        return false;
    }
    return true;
}

if(validate()){
   $stmt = $pdo->prepare("INSERT INTO reviews(TITLE, MESSAGE, USER_ID) VALUES( :title, :message, :user_id)");
    $result = $stmt->execute(['title'=>$title, 'message'=>$message, 'user_id'=>$id ]);
    if($result){
        echo 'Данные успешно сохранены<br>';
        echo '<script>setTimeout(()=>{location.replace("/")}, 1200);</script>'; exit;
        
    }else{
        echo 'Данные не сохнанены!!!' ;
        echo '<script>setTimeout(()=>{location.replace("/")}, 1200);</script>'; exit;
    } 
}else{
echo 'data not valid';
echo '<script>setTimeout(()=>{location.replace("/")}, 1200);</script>'; exit;
}




