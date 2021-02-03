<?php
class User{
    private $id;
    private $name;
    private $phone;
    private $email;
    private $role_id;
    
    public function __construct($name, $phone, $email){
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
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
    
    
    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getRoleId(){
        return $this->role_id;
    }
    
    public function setRoleId($role){
        $this->role_id = $role;
    }
}
