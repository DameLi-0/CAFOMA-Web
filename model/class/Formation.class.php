<?php
class Formation implements JsonSerializable{
    
    private $formation_id;
    private $fk_user_id;
    private $libelle;
    private $acronyme;
    private $description;
    private $img;
    private $video;
    private $tab_sequence = array();
    
    function __construct($formation_id, $fk_user_id, $libelle, $acronyme, $description, $img, $video) {
        $this->formation_id = $formation_id;
        $this->fk_user_id = $fk_user_id;
        $this->libelle = $libelle;
        $this->acronyme = $acronyme;
        $this->description = $description;
        $this->img = $img;
        $this->video = $video;
    }
    
    public function __toString() {
        return "formation_id=".$this->formation_id. "fk_user_id=".$this->fk_user_id. "libelle=".$this->libelle. "acronyme=".$this->acronyme. "description=".$this->description. "img=".$this->img. "tab_sequence=".$this->tab_sequence. "video".$this->video. "tab_sequence".$this->tab_sequence;
    }

    public function getFormation_id(){return $this->formation_id;}
    public function setFormation_id($formation_id){$this->formation_id = $formation_id;}    
    
    public function getFk_user_id(){return $this->fk_user_id;}
    public function setFk_user_id($fk_user_id){$this->fk_user_id = $fk_user_id;}    
    
    public function getLibelle(){return $this->libelle;}
    public function setLibelle($libelle){$this->libelle = $libelle;}
    
    public function getAcronyme(){return $this->acronyme;}
    public function setAcronyme($acronyme){$this->acronyme = $acronyme;}
    
    public function getDescription(){return $this->description;}
    public function setDescription($description){$this->description = $description;}

    public function getImg(){return $this->img;}
    public function setImg($img){$this->img = $img;}  
    
    public function getVideo(){return $this->video;}
    public function setVideo($video){$this->video = $video;}      
    
    public function getTab_sequence(){return $this->tab_sequence;}
    public function setTab_sequence($tab_sequence){$this->tab_sequence = $tab_sequence;}       

    public function jsonSerialize() {
        return $this->array;
    }

}