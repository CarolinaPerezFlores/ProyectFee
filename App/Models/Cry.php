<?php
namespace App\Models;
// require_once 'BaseElement.php';
// require_once 'Printable.php';

class Cry extends BaseElement implements Printable  {
        
    // El constructor es para inicializar valores
    public function __construct($primerParametro, $segundoParametro, $terserParametro){
    $this->company = $primerParametro;    
    $this->comment = $segundoParametro; 
    $this->tres = $terserParametro; 
    }

    public function getDescription(){
        echo '<h5>' . $this->company . '</h5>';
    }
}