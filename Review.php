<?php
class Review{
    private $title;
    private $message;
    private $date;
    private $name;
    private $phone;
    private $email;
    private $isPublic;
    private $editMode;
    private $ANSWER;
    
    public function __construct($user, $title, $message){
        $this->title = $title;
        $this->message = $message;
        $this->date = date("Y-m-d H:i:s");
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->isPublic = false;
        $this->editMode = false;
        $this->ANSWER = NULL;
    }
    
    public function getTitle(){
        return $this->title;
    }
    
    public function getMessage(){
        return $this->message;
    }
    
    public function getDate(){
        return $this->date;
    }
        
    public function getName(){
        return $this->name;
    }
    
    public function getPhone(){
        return $this->phone;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function getStatus(){
        return $this->isPublic;
    }
    
    public function setIsPublic($bool){
        $this->isPublic = $bool;
    }
    
    public function getEditMode(){
        return $this->editMode;
    }
    
    public function setEditMode($bool){
        $this->editMode = $bool;
    }
    
    public function getAnswer(){
        return $this->ANSWER;
    }
    
    public function setAnswer($answer){
        $this->ANSWER = $answer;
    }
    
}
?>