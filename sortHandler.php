<?php

require_once 'connection.php';
var_dump($_POST);
$action = $_POST['action'];

if($action == 'showpublished'){
    $stmt = $pdo->prepare("SELECT * FROM reviews");
}
if($action == 'delete'){
    $stmt = $pdo->prepare("DELETE FROM REVIEWS WHERE REWIEW_ID=:REVIEW_ID");
}


$stmt->execute(['REVIEW_ID' => $review_id]);

echo '<script>location.replace("/");</script>'; exit;