<?php
class Inscription implements JsonSerializable {
    
    private $inscription_id;
    private $fk_formation_id;
    private $fk_user_id;
    private $date;

    
    function __construct($fk_formation_id, $fk_user_id) {

        $this->fk_formation_id= $fk_formation_id;
        $this->fk_user_id = $fk_user_id;
        $this->date = $date = date('Y-m-d');
    }
    
    public function __toString() {
        return "inscription_id".$this->inscription_id. "fk_formation_id=".$this->fk_formation_id. "fk_user_id=".$this->fk_user_id. "date=".$this->date;
    }
    
    public function getInscription_id(){return $this->inscription_id;}
    public function setInscription_id($inscription_id){$this->inscription_id = $inscription_id;}   
    
    public function getFk_formation_id(){return $this->fk_formation_id;}
    public function setFk_formation_id($fk_formation_id){$this->fk_formation_id = $fk_formation_id;}    
    
    public function getFk_user_id(){return $this->fk_user_id;}
    public function setFk_user_id($fk_user_id){$this->fk_user_id = $fk_user_id;}    

    public function getDate(){return $this->date;}
    public function setDate($date){$this->date = $date;}
    

   public function jsonSerialize() {
        return $this->array;
    }

}