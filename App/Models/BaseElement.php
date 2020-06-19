<?php
// namespace App\Models;
// require_once 'vendor/autoload.php';
// use Illuminate\Database\Eloquent\Model;

// class BaseElement {
        
//         // El constructor es para inicializar valores
//         public function __construct($primerParametro, $segundoParametro){
//         $this->company = $primerParametro;    
//         $this->comment = $segundoParametro; 
//         }
//         public function printProposals(){
//             // sintaxis de arreglo
//             // echo '<h5>' . $proposals['company'] . '</h5>';
//             echo '<h5>' . $this->company . '</h5>';
//             echo '<h5>' . $this->comment . '</h5>';
//         }
//     }

namespace App\Models;

require_once 'Printable.php';

class BaseElement implements Printable {
    public $company;
    public $comment;
    

    public function __construct($company, $comment) {
        $this->$company=$company;
        $this->$comment = $comment;
    }

    public function getDurationAsString() {
        echo '<h5>' . $this->company . '</h5>';
        echo '<h5>' . $this->comment . '</h5>';
    }

    public function getDescription() {
        return $this->coment;
    }

    public function printProposals() {
        return $this->coment;
    }
}