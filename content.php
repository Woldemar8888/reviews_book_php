<?php
require_once 'connection.php';
//получение текущей страницы
if(isset($_GET['page'])){
    $page =(int) $_GET['page'];
}else{
   $page = 1; 
}

//получение роли и id пользователя
$id = (isset($_SESSION['user']))? $_SESSION['user']->getId(): NULL;
$role_id = (isset($_SESSION['user']))? $_SESSION['user']->getRoleId(): NULL;


if($role_id ==1){
    $stmt = $pdo->query('SELECT PUBLIC, EDITMODE FROM settings');
    $row = $stmt->fetch();
    $showReviewMode = $row['PUBLIC'];
    $editMode = $row['EDITMODE'];
    
    if($editMode){
        $options = 'WHERE REVIEWS.editMode = true';
    }else{
        switch($showReviewMode){
        case 'showall' :
            $options = '';
            break;
        case 'public':
            $options = 'WHERE REVIEWS.isPublic = true';
            break;
        case 'unpublic':
            $options = 'WHERE REVIEWS.isPublic = false';
            break;
        case 'unpublic':
            $options = 'WHERE REVIEWS.isPublic = false';
            break;
        case 'hasanswer':
            $options = 'WHERE REVIEWS.ANSWER IS NOT NULL';
            break;
        case 'nosanswer':
            $options = 'WHERE REVIEWS.ANSWER IS NULL';
            break;
        default:
            $options = '';
    } 
    }
    
   
    
    $stmt1 = $pdo->prepare("SELECT count(*) FROM reviews $options");
    
}else{
    $stmt1 = $pdo->prepare("SELECT count(*) FROM reviews WHERE isPublic=true");
}

$stmt1->execute();

$length = 0;
if($stmt1){
    $str = $stmt1->fetch();
    $length = (int) $str[0];
}

$portionCount = (int) ceil( $length/5);
$start = $page < 4 ? 1 : $page -3;
$end =  ($start + 4) < $portionCount ? $start + 4 : $portionCount;
$portion = $page;
$from = $portion * 5 - 5; ;
$limit = 5;

if($role_id == 1){
    $stmt2 = $pdo->prepare("SELECT REVIEW_ID,TITLE, MESSAGE, DATE, NAME, PHONE, EMAIL, isPublic, editMode, ANSWER FROM reviews JOIN users ON users.USER_ID = reviews.USER_ID $options LIMIT $from, $limit" );
}else{
     $stmt2 = $pdo->prepare("SELECT REVIEW_ID,TITLE, MESSAGE, DATE, NAME, PHONE, EMAIL, isPublic, ANSWER FROM users JOIN reviews ON users.USER_ID = reviews.USER_ID WHERE isPublic=true LIMIT $from, $limit" );   
}

$stmt2->execute();
$data = [];

if($stmt2){
   while ($str = $stmt2->fetch()) {
    $data[] = $str;
   }   
}

if($role_id == 1){
?>

<?php
if(!$editMode){
?>
<div class="settings">
    <form action="publicHandler.php" method="post">
        <input type="hidden" name="setting" value="showall">
        <input type="submit" value="Все отзывы" class="admin-button">
    </form>
    <form action="publicHandler.php" method="post">
        <input type="hidden" name="setting" value="public">
        <input type="submit" value="Опубликованные" class="admin-button">
    </form>
    <form action="publicHandler.php" method="post">
        <input type="hidden" name="setting" value="unpublic">
        <input type="submit" value="В ожидании" class="admin-button">
    </form>
    <form action="publicHandler.php" method="post">
        <input type="hidden" name="setting" value="nosanswer">
        <input type="submit" value="Без ответа" class="admin-button">
    </form>
    <form action="publicHandler.php" method="post">
        <input type="hidden" name="setting" value="hasanswer">
        <input type="submit" value="С ответом" class="admin-button">
    </form>
</div>

<?php }}
//отрисовка всех отзывов
foreach($data as $review){
?>

<div class="review">
   <div class="review-header">
       <div class="title"><?php echo $review['TITLE'] ?>
       </div>
       <div class="time"><span><?php echo $review['DATE'] ?></span>
       </div>
   </div>
<?php
    if($role_id ==1 && $review['editMode']){
?>
<div class="message-area">
    <form action="publicHandler.php" method="post">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="review_id" value="<?php echo $review['REVIEW_ID'] ?>">
        <textarea name="editMessage"         class="editMessage" cols="30" rows="10">
            <?php echo $review['MESSAGE'] ?>
        </textarea>
        <input type="submit" value="Сохранить" class="admin-button save">
    </form> 
</div>
       
    <?php }else{?>
        <p class="message"><?php echo $review['MESSAGE'] ?></p>
    <?php }?>
    <div class="user-data">
        <div class="name"><?php echo $review['NAME'] ?>
        </div>
        <div class="phone"><?php echo $review['PHONE'] ?>
        </div>
        <div class="email"><?php echo  $review['EMAIL'] ?>
        </div>
    </div>
    <div class="add-review">
    <?php if($role_id ==1 && $review['editMode']){
    ?>    
    <form action="publicHandler.php" method="post" id="addReview">
       <input type="hidden" name="review_id" 
       value="<?php echo $review['REVIEW_ID'] ?>">
       <input type="hidden" name="action" value="addanswer">
       <div class="message-area">
           <textarea name="answer" id="add-review-message" class="editMessage" cols="30" rows="10" placeholder="Написать ответ"><?php echo $review['ANSWER'] ?></textarea>
           <input type="submit">
       </div>
    </form>
    <?php }?>
</div>
   <?php if($review['ANSWER']) { ?>
    <div class="answer"><?php echo '<p>ОТВЕТ:</p><p>'. $review['ANSWER'].'</p>' ?></div>
    <?php }?>
    <?php
    if($role_id == 1){
    ?>
    <div class="review-admin-panel">
        <p class="review-status">Статус: <?php echo $review['isPublic'] ? 'Опубликован': 'в ожидании'   ?></p>
        <form action="publicHandler.php" method="post">
            <input type="hidden" name="action" value="public">
            <input type="hidden" name="review_id" value="<?php echo $review['REVIEW_ID'] ?>">
            <input type="submit" value="Опубликовать" class="admin-button public-action">
        </form>
        <form action="publicHandler.php" method="post">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="review_id" value="<?php echo $review['REVIEW_ID'] ?>">
            <input type="submit" value="Удалить" class="admin-button delete">
        </form>
        <form action="publicHandler.php" method="post">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="review_id" value="<?php echo $review['REVIEW_ID'] ?>">
            <input type="submit" value="Редактировать" class="admin-button">
        </form>
        
    </div>
    <?php } ?>
</div>
<?php } ?>

<?php 
if(isset($id) && $role_id != 1){
?>    
<!--отрисовка формы добавления-->
<div class="add-review message-area">
    <form action="addReviewHandler.php" method="post" id="addReview">
       <input type="hidden" name="id" 
       value="<?php echo $id ?>">
       <input type="text" name="title" placeholder="Написать заголовок">
        <textarea name="message" id="add-review-message" cols="30" rows="10" placeholder="Написать отзыв"></textarea>
        <input type="submit">
    </form>
    
</div>
<?php } ?>
<!--отрисовка пагинации-->
<div class="pagination">
  
   <?php
        for($i= $start; $i <= $end; $i++){
            if($page == $i ){
                $class = "pagination-button activ";
            }else{
                $class ="pagination-button";
            }
    ?>
        <a class="<?php echo $class ?>" href="?page=<?php echo $i ?>"><?php echo $i ?></a>
    
    
    <?php }?>
</div>




