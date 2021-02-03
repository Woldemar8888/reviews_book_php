<?php

var_dump($_POST);

require_once 'connection.php';
$action = $_POST['action'];
$editMessage = $_POST['editMessage'];
$review_id = (int) $_POST['review_id'];
$answer = $_POST['answer'];
$setting = $_POST['setting'];


if($setting){
    $stmt = $pdo->prepare("UPDATE settings SET PUBLIC = :NAME");
    $stmt->execute(['NAME' => $setting]);
}

if($action && $review_id){
    if($action == 'public'){
        $stmt = $pdo->prepare("UPDATE REVIEWS SET isPublic = true WHERE REVIEW_ID=:REVIEW_ID");
    }
    if($action == 'delete'){
        $stmt = $pdo->prepare("DELETE FROM REVIEWS WHERE REVIEW_ID=:REVIEW_ID");
    }
    if($action == 'edit'){
        $stmt = $pdo->prepare("UPDATE REVIEWS SET editMode = true  WHERE REVIEW_ID=:REVIEW_ID");
        $st = $pdo->query("UPDATE settings SET EDITMODE = true");
    }
    if($action == 'save'){
        $stmt = $pdo->prepare("UPDATE REVIEWS SET editMode = false, MESSAGE=:MESSAGE WHERE REVIEW_ID=:REVIEW_ID");
        $st = $pdo->query("UPDATE settings SET EDITMODE = false");
    }
    if($action == 'addanswer'){
        $stmt = $pdo->prepare("UPDATE REVIEWS SET editMode=false, ANSWER=:ANSWER WHERE REVIEW_ID=:REVIEW_ID");
        $st = $pdo->query("UPDATE settings SET EDITMODE = false");
    }
    if($editMessage){
        $stmt->execute(['REVIEW_ID' => $review_id, 'MESSAGE' => $editMessage]);
    }else if($answer){
        $stmt->execute(['REVIEW_ID' => $review_id, 'ANSWER' => $answer]);
    }else{
        $stmt->execute(['REVIEW_ID' => $review_id]);
    }
    
    
}

echo '<script>location.replace("/");</script>'; exit;
