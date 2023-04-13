<?php
class User implements JsonSerializable{

    private $login;
    private $mdp;
    private $email;
    private $img;
    private $role;
    private $valid;
 
    function __construct($user_id, $login, $mdp, $email, $img, $role, $valid) {
      
        $this->user_id = $user_id;
        $this->login = $login;
        $this->mdp = $mdp;
        $this->email = $email;
        $this->img = $img;
        $this->role = $role;
        $this->valid = $valid;
    }
    
    public function __toString() {
        return "user_id=".$this->user_id. "login=".$this->login. "mdp=".$this->mdp. "email=".$this->email. "img=".$this->img. "role=".$this->role. "valid=".$this->valid;
    }
    
    public function getUser_id(){return $this->user_id;}
    public function setUser_id($user_id){$this->user_id = $user_id;}  
    
    public function getLogin(){return $this->login;}
    public function setLogin($login){$this->login = $login;}
    
    public function getMdp(){return $this->mdp;}
    public function setMdp($mdp){$this->mdp = $mdp;}   
    
    public function getEmail(){return $this->email;}
    public function setEmail($email){$this->email = $email;}       
    
    public function getImg(){return $this->img;}
    public function setImg($img){$this->img = $img;} 
    
    public function getRole(){return $this->role;}
    public function setRole($role){$this->role = $role;}

    public function getValid(){return $this->valid;}
    public function setValid($valid){$this->valid = $valid;}    
    
    public function jsonSerialize() {
        return $this->array;
    }

}
    