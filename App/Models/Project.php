<?php
namespace App\Models;
require_once 'vendor/autoload.php';
// // require_once 'BaseElement.php';
use Illuminate\Database\Eloquent\Model;

// class Project extends BaseElement{
//     // El constructor es para inicializar valores
//     protected $table = 'proposals';
  
//         public function printProposals(){
//             // // sintaxis de arreglo
         
//         }
// }



// namespace App\Models;

class Project extends Model{
    public $table = 'proposals';
    public function getDescription() {
        
    }

}