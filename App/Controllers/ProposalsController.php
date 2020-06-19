<?php
namespace App\Controllers;
use App\Models\Proposal;
use App\Models\Person;
use App\Models\Search;
use Respect\Validation\Validator as v;
use Zend\Diactoros\Response\RedirectResponse;
// Use Cookie;

class ProposalsController extends BaseController {
    public function getAddProposalAction($request) {
      $proposals = Proposal::latest()->get();
      // $proposals = Proposal::find(7);
      // $proposals = Proposal::latest()
      // ->take(52)
      // ->get();
      $responseMessage = null;
      $proposalsTitle = 'Mira todas las ideas';

      $cookie_name = "userIdFeebulari";
      $cookie_value = uniqid();
     
      if(!isset($_COOKIE[$cookie_name])) {
        setcookie($cookie_name, $cookie_value,time() + 60*60*24*30, "/");
      } 


         return $this->renderHTML('add-proposal.twig', [
          
          'proposals' => $proposals,
          'responseMessage'=>$responseMessage,
          'proposalsTitle' => $proposalsTitle
         ]);

        
        // location.reload();
    }



    public function postSearch($request) {
      
      // $searchs =  Proposal::where('company', 'LIKE', "%{$postData['companyInput']}%")->get();
      $responseMessage = null;
      $postData = $request->getParsedBody();
      
      $company = $postData['company'] ?? '';
      $companyInput = $postData['companyInput'] ?? '';
      $person = $postData['person'] ?? '';
      $minus = $postData['minus'] ?? '';
      $more = $postData['more'] ?? '';
      $cookie_name = "userIdFeebulari";
    
      
  // Éste if es para request de imout commpany
      if($company){
        // echo  '<script name="accionCompany">alert("Estás seguro que deceas enviar la propuesta")</script>';
       
        $proposals = Proposal::latest()->get();
        $proposalValidator = v::key('company', v::stringType()->notEmpty());
                      // ->key('comment', v::stringType()->notEmpty());
                      
        try{ 

          $proposalValidator->assert($postData);  
          $postData = $request->getParsedBody();  
          $proposal = new Proposal();
          $proposal->company = $postData['company'];
          // $proposal->comment = $postData['comment'];
          $proposal->save();
          return new RedirectResponse('/#propuestas');


          
        } catch (\Exception $e) {
          $responseMessage = $e->getMessage();
        }            
        return $this->renderHTML('add-proposal.twig', [
          'proposals' => $proposals,
          'responseMessage' => $responseMessage
 ]);
        
        
      }
      


      // Éste if es para request de input commpanyImput
      if ($companyInput){
          $proposals =  Proposal::where('company', 'LIKE', "%{$postData['companyInput']}%")->get();
          $proposalValidator = v::key('companyInput', v::stringType()->notEmpty());

  
          try{
            $proposalValidator->assert($postData);  
            $postData = $request->getParsedBody();       
            $proposal = new Proposal();
            $proposal->company = $postData['companyInput'];
            $proposalsTitle= 'Resuldatos de ' . '"' . "{$postData['companyInput']}" . '"';
            // $proposalsTitle= 'resuldatos de ' ;
            // $responseMessage = 'saved';
          } catch (\Exception $e) {
            $responseMessage = $e->getMessage();
          }            
          return $this->renderHTML('add-proposal.twig', [
            'proposals' => $proposals,
            'responseMessage' => $responseMessage,
            'proposalsTitle' => $proposalsTitle
   ]); 
          
          
        }
        

// Éste if es para request de minus
        if ($minus) {

          $proposals = Proposal::latest()->get();
          $proposalValidator = v::key('minus', v::stringType()->notEmpty());

            try{
              $proposalValidator->assert($postData);  
              $postData = $request->getParsedBody();
              $proposals = Proposal::latest()->get();
              $cookie_name = "userIdFeebulari";

//  Si no tiene cookie hasla
                if(!isset($_COOKIE[$cookie_name])) {
                  $cookie_name = "userIdFeebulari";
                  $cookie_value = uniqid();
                  setcookie($cookie_name, $cookie_value,time() + 60*60*24*30, "/");
                 
                } 
//  Entonces sigue el código utilizando la cookie para hacer una consulta.
                else {
                            
                  $userMinusMatches = Person::where('personId', $_COOKIE[$cookie_name])
                  ->where('minusIdCard', $postData['minus'])
                  ->get();
//si la consulta es exitosa, no hagas nada  
                            if(isset($userMinusMatches[0]->minusIdCard)){
                                      // no hagas nada
                                
                                    }
// entonces, si no es exitosa la consulta, has al suma de puntaje. 
// Y además ponlo en la lista "negra" para que entre en el if anterior.
                            else { 
                              $proposals = Proposal::where('id', $postData['minus'])
                              ->update(['points' => Proposal::raw('points-1')]);

                            $person = new Person();
                            $person->personId = $_COOKIE[$cookie_name];
                            $person->minusIdCard = $postData['minus'];
                            $person->save();
                          } 
                          
                }
              //  return new RedirectResponse('/');
              $proposals = Proposal::latest()->get();

            } catch (\Exception $e) {
              $responseMessage = $e->getMessage();
            }            
            return $this->renderHTML('add-proposal.twig', [
              'proposals' => $proposals,
              'responseMessage' => $responseMessage
     ]);     
          }




// Éste if es para request de input more
          if ($more) {
            $proposals = Proposal::all();
            $proposalValidator = v::key('more', v::stringType()->notEmpty());
   
            try{
              $proposalValidator->assert($postData);  
              $postData = $request->getParsedBody();
              $proposals = Proposal::latest()->get();
              $cookie_name = "userIdFeebulari";

  //  Si no tiene cookie hasla
                if(!isset($_COOKIE[$cookie_name])) {
                  $cookie_name = "userIdFeebulari";
                  $cookie_value = uniqid();
                  setcookie($cookie_name, $cookie_value,time() + 60*60*24*30, "/");
                 
                } 
//  Entonces sigue el código utilizando la cookie para hacer una consulta.
                else {
                            
                  $userMoreMatches = Person::where('personId', $_COOKIE[$cookie_name])
                  ->where('moreIdCard', $postData['more'])
                  ->get();
//si la consulta es exitosa, no hagas nada  
                            if(isset($userMoreMatches[0]->moreIdCard)){
                                      // no hagas nada
                                
                                    }
// entonces, si no es exitosa la consulta, has al suma de puntaje. 
// Y además ponlo en la lista "negra" para que entre en el if anterior.
                            else { 
                              $proposals = Proposal::where('id', $postData['more'])
                              ->update(['points' => Proposal::raw('points+1')]);

                            $person = new Person();
                            $person->personId = $_COOKIE[$cookie_name];
                            $person->moreIdCard = $postData['more'];
                            $person->save();
                          } 
                          
                }

                  return new RedirectResponse('/');
                  $enviado= false;
              } catch (\Exception $e) {
                $responseMessage = $e->getMessage();
              }            
              return $this->renderHTML('add-proposal.twig', [
                'proposals' => $proposals,
                'responseMessage' => $responseMessage
       ]); 
              
              
            }







            else {
              
              $proposals = Proposal::all();
              // $responseMessage= 'agrega algo!';
              
      
            $proposalValidator =  
            v::key('company', v::stringType()->notEmpty()); 
            v::key('more', v::stringType()->notEmpty()); 

      
            try{
              $proposalValidator->assert($postData);  
              $postData = $request->getParsedBody();
            } catch (\Exception $e) {
              // $responseMessage = $e->getMessage();
              echo  '<script name="accion">alert("Algún campo está vacío. Debes rellenarlo") </script>';
            }            
            return $this->renderHTML('add-proposal.twig', [
              'proposals' => $proposals,
              'responseMessage' => $responseMessage
      ]);  
            }
  
  
          }
        }
  


