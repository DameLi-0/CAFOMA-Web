<?php
class Ressource implements JsonSerializable {
    
    private $ressource_id;
    //private $fk_formation_id;
    //private $fk_sequence_id;
    private $link;

    
    function __construct($ressource_id, $fk_formation_id, $fk_sequence_id, $link) {
        $this->ressource_id = $ressource_id;
        $this->fk_formation_id= $fk_formation_id;
        $this->fk_sequence_id = $fk_sequence_id;
        $this->link = $link;
    }
    
    public function __toString() {
        return "ressource_id=".$this->ressource_id. "fk_formation_id=".$this->fk_formation_id. "fk_sequence_id=".$this->fk_sequence_id. "link=".$this->link;
    }

    public function getRessource_id(){return $this->ressource_id;}
    public function setRessource_id($ressource_id){$this->ressource_id = $ressource_id;}    
    
    public function getFk_formation_id(){return $this->fk_formation_id;}
    public function setFk_formation_id($fk_formation_id){$this->fk_formation_id = $fk_formation_id;}    
    
    public function getFk_sequence_id(){return $this->fk_sequence_id;}
    public function setFk_sequence_id($fk_sequence_id){$this->fk_sequence_id = $fk_sequence_id;}
    
    public function getLink(){return $this->link;}
    public function setLink($link){$this->link = $link;}
    

   public function jsonSerialize() {
        return $this->array;
    }

}