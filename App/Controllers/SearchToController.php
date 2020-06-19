<?php
namespace App\Controllers;
use App\Models\Search;
use Zend\Diactoros\Response\RedirectResponse;
// use Respect\Validation\Validator as v;

class SearchToController extends BaseController {
    public function getSearchUser() {
      $responseMessageee = 'hey!';
      
        return $this->renderHTML('search.twig', [
  // 'filtere' => $filtere,
  'responseMessageee' => $responseMessageee
 ]);
        // $responseMessageee = 'hey!';
    }

    public function postSearchUser($request) {
     
        $postData = $request->getParsedBody();
        // $filtere =  Search::where('company', 'LIKE', "%{$postData['companyInput']}%")->get();
        $responseMessageee = 'hey!';
        if($postData['companyInput']== null ){
          $responseMessageee = 'Ingresa el nombre de una empresa';
          return $this->renderHTML('search.twig', [
            'responseMessageee' => $responseMessageee
           ]);
          
        }  elseif  ($postData['companyInput']== " " ){
          // ltrim($postData['companyInput'], "\t");
          // echo($postData['companyInput']);
          $responseMessageee = 'No se encontraron resultados';
          return $this->renderHTML('search.twig', [
            'responseMessageee' => $responseMessageee
           ]);


        } else {
          $filtere =  Search::where('company', 'LIKE', "%{$postData['companyInput']}%")->get();
         $responseMessageee = 'Resultados de' . ' "' .  "{$postData['companyInput']}" . '"';
              $sear = new Search();
              $sear->company = $postData['companyInput'];
              
                
                return $this->renderHTML('search.twig', [
          'filtere' => $filtere,
          'responseMessageee' => $responseMessageee
         ]); 
               
      }
    }
  }