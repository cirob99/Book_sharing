<?php
	class Domanda {
	  private $idBook;
	  private $titolo;
	  private $autore;
	  private $descrizione;
	  private $categoria; 
	  
	  //public function __construct($id, $txt, $pt, $campo) {

	    //$this->idBook = $id;
	    //$this->titolo = $tit;
		//$this->autore = $aut;
		//$this->descrizione = $desc;
	    //$this->categoria = $cat; 
		//}

	  public function getIdBook() {
	    return $this->idBook;
	  }
	  public function setIdBook($id) {
	    $this->idBook = $id;
	  }
	  public function getTitolo() {
	    return $this->titolo;
	  }
	  public function setTitolo($tit) {
	    $this->titolo = $tit;
	  }
	  public function getAutore() {
	    return $this->autore;
	  }
	  public function setAutore($aut) {
	    $this->autore = $aut;
	  }
	  public function getDescrizione() {
	    return $this->descrizione;
	  }
	  public function setDescrizione($desc) {
	    $this->descrizione = $desc;
	  }
	  public function getCategoria() { // restituisce un array
	    return $this->categoria;
	  }
	  public function setCategoria($cat) { // richiede in input un array
	    $this->categoria = $cat;
	  }
	  
}

?>