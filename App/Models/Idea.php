<?php
namespace App\Models;
// require_once '../vendor/autoload.php';
// require_once 'BaseElement.php';
use Illuminate\Database\Eloquent\Model;


class Idea extends Model{
    protected $table = 'ideas';
      
            public function printProposals(){
                // sintaxis de arreglo
                // echo '<h5>' . $proposals['company'] . '</h5>';
            }

            public function getDurationAsString() {
                echo '<h5>' . $this->company . '</h5>';
                echo '<h5>' . $this->comment . '</h5>';
            }
        
        }


// namespace App\Models;
// require_once 'vendor/autoload.php';

// use Illuminate\Database\Eloquent\Model;

// class Proposal extends Model {
//     public $table = 'proposals';
//     public $company = 'company';
//     public $comment = 'comment';
    


//     public function getDurationAsString() {
//         echo '<h5>' . $this->company . '</h5>';
//         echo '<h5>' . $this->comment . '</h5>';
//     }

//     public function getDescription() {
//         return $this->coment;
//     }
// }