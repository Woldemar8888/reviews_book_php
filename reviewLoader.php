<?php
header("Access-Control-Allow-Origin: *");

require_once 'connection.php';

//$text = file_get_contents('php://input');
//$assocArr = json_decode($text, true);

$stmt = $pdo->prepare("SELECT TITLE, MESSAGE, DATE, NAME, PHONE, EMAIL FROM reviews JOIN users ON users.USER_ID = reviews.USER_ID");

$stmt->execute();

$data = [];

if($stmt){
   while ($str = $stmt->fetch()) {
    $data[] = $str;
   }   
}
 
$json = json_encode($data);
echo $json;
?>