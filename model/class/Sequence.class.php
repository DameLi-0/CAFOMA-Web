<?php
class Sequence implements JsonSerializable {
    
    private $sequence_id;
    //private $fk_formation_id;
    private $libelle;
    private $description;
    private $tab_ressource = array();

    
    function __construct($sequence_id, $fk_formation_id, $libelle, $description) {
        $this->sequence_id = $sequence_id;
        $this->fk_formation_id= $fk_formation_id;
        $this->libelle = $libelle;
        $this->description = $description;
    }
    
    public function __toString() {
        return "sequence_id=".$this->sequence_id. "fk_formation_id=".$this->fk_formation_id. "libelle=".$this->libelle. "description=".$this->description. "tab_ressource=".$this->tab_ressource;
    }

    public function getSequence_id(){return $this->sequence_id;}
    public function setSequence_id($sequence_id){$this->sequence_id = $sequence_id;}    
    
    public function getFk_formation_id(){return $this->fk_formation_id;}
    public function setFk_formation_id($fk_formation_id){$this->fk_formation_id = $fk_formation_id;}    
    
    public function getLibelle(){return $this->libelle;}
    public function setLibelle($libelle){$this->libelle = $libelle;}
    
    public function getDescription(){return $this->description;}
    public function setDescription($description){$this->description = $description;}
    
    public function getTab_ressource(){return $this->tab_ressource;}
    public function setTab_ressource($tab_ressource){$this->tab_ressource = $tab_ressource;}    

   public function jsonSerialize() {
        return $this->array;
    }

}