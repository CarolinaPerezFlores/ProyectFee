<?php
namespace App\Controllers;
use App\Models\Idea;
use App\Models\Person;
use App\Models\Search;
use Respect\Validation\Validator as v;
use Zend\Diactoros\Response\RedirectResponse;
// Use Cookie;

class IdeasController extends BaseController {
    public function getAddIdeaAction($request) {
      $ideas = Idea::latest()->get();
      // $proposals = Proposal::find(7);
      // $proposals = Proposal::latest();
      // ->take(52)
      // ->get();
      $responseMessage = null;
      $ideasTitle = 'Mira todas las ideas';

      $cookie_name = "userIdFeebulari";
      $cookie_value = uniqid();
      $cookie_found = true;
     
      if(!isset($_COOKIE[$cookie_name])) {
        setcookie($cookie_name, $cookie_value,time() + 60*60*24*30, "/");
        $cookie_found = false;
        // echo '<div class="mydiv">' .prueba(). '</div>';
      } 


         return $this->renderHTML('add-idea.twig', [
          
          'ideas' => $ideas,
          'responseMessage'=>$responseMessage,
          'ideasTitle' => $ideasTitle,
          'cookie_found' => $cookie_found
         ]);

        
        // location.reload();
    }










    public function postSearch($request) {
      
      // $searchs =  Proposal::where('company', 'LIKE', "%{$postData['companyInput']}%")->get();
      $responseMessage = null;
      $postData = $request->getParsedBody();
      
      $textIdea = $postData['textIdea'] ?? '';
      $ideaInput = $postData['ideaInput'] ?? '';
      $person = $postData['person'] ?? '';
      $minus = $postData['minus'] ?? '';
      $more = $postData['more'] ?? '';
      $cookie_name = "userIdFeebulari";
    
      
  // Éste if es para request de imout commpany
      if($textIdea){
        // echo  '<script name="accionCompany">alert("Estás seguro que deceas enviar la propuesta")</script>';
       
        $ideas = Idea::latest()->get();
        $ideaValidator = v::key('textIdea', v::stringType()->notEmpty());
                      // ->key('comment', v::stringType()->notEmpty());
                      
        try{ 

          if(preg_match('/http|www/i',$textIdea)) {
           echo  '<script name="accion">alert("Carácteres de contacto no permitidos") </script>';
          }
          else {

          $ideaValidator->assert($postData);  
          $postData = $request->getParsedBody();  
          $idea = new Idea();
          $idea->idea = $postData['textIdea'];
          // $proposal->comment = $postData['comment'];
          $idea->save();
          return new RedirectResponse('/#ideas');
          }

          
        } catch (\Exception $e) {
          $responseMessage = $e->getMessage();
        }            
        return $this->renderHTML('add-idea.twig', [
          'ideas' => $ideas,
          'responseMessage' => $responseMessage
 ]);
        
        
      }
      


      // Éste if es para request de input commpanyImput
      if ($ideaInput){
          $ideas =  Idea::where('idea', 'LIKE', "%{$postData['ideaInput']}%")->get();
          $ideaValidator = v::key('ideaInput', v::stringType()->notEmpty());

  
          try{
            $ideaValidator->assert($postData);  
            $postData = $request->getParsedBody();       
            $idea = new Idea();
            $idea->idea = $postData['ideaInput'];
            $ideasTitle= 'Resuldatos de ' . '"' . "{$postData['ideaInput']}" . '"';
            // $proposalsTitle= 'resuldatos de ' ;
            // $responseMessage = 'saved';
          } catch (\Exception $e) {
            $responseMessage = $e->getMessage();
          }            
          return $this->renderHTML('add-idea.twig', [
            'ideas' => $ideas,
            'responseMessage' => $responseMessage,
            'ideasTitle' => $ideasTitle
   ]); 
          
          
        }
        

// Éste if es para request de minus
        if ($minus) {

          $ideas = Idea::latest()->get();
          $ideaValidator = v::key('minus', v::stringType()->notEmpty());

            try{
              $ideaValidator->assert($postData);  
              $postData = $request->getParsedBody();
              $ideas = Idea::latest()->get();
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
                              $ideas = Idea::where('id', $postData['minus'])
                              ->update(['points' => Idea::raw('points-1')]);

                            $person = new Person();
                            $person->personId = $_COOKIE[$cookie_name];
                            $person->minusIdCard = $postData['minus'];
                            $person->save();
                          } 
                          
                }
              //  return new RedirectResponse('/');
              $ideas = Idea::latest()->get();

            } catch (\Exception $e) {
              $responseMessage = $e->getMessage();
            }            
            return $this->renderHTML('add-idea.twig', [
              'ideas' => $ideas,
              'responseMessage' => $responseMessage
     ]);     
          }




// Éste if es para request de input more
          if ($more) {
            $ideas = Idea::all();
            $ideaValidator = v::key('more', v::stringType()->notEmpty());
   
            try{
              $ideaValidator->assert($postData);  
              $postData = $request->getParsedBody();
              $ideas = Idea::latest()->get();
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
                              $ideas = Idea::where('id', $postData['more'])
                              ->update(['points' => Idea::raw('points+1')]);

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
              return $this->renderHTML('add-idea.twig', [
                'ideas' => $ideas,
                'responseMessage' => $responseMessage
       ]); 
              
              
            }













            else {
              
              $ideas = Idea::all();
              // $responseMessage= 'agrega algo!';
              
      
            $ideaValidator =  
            v::key('idea', v::stringType()->notEmpty()); 
            v::key('more', v::stringType()->notEmpty()); 

      
            try{
              $ideaValidator->assert($postData);  
              $postData = $request->getParsedBody();
            } catch (\Exception $e) {
              // $responseMessage = $e->getMessage();
              echo  '<script name="accion">alert("Algún campo está vacío. Debes rellenarlo") </script>';
            }            
            return $this->renderHTML('add-idea.twig', [
              'ideas' => $ideas,
              'responseMessage' => $responseMessage
      ]);  
            }
  
  
          }
        }
  


