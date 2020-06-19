<?php
namespace App\Controllers;
use App\Models\User;
use Respect\Validation\Validator as v;
use Zend\Diactoros\Response\RedirectResponse;

class SearchController extends BaseController {
    public function postLogin($request) {
        $postData = $request->getParsedBody();
        $proposals = Proposal::all();
        $proposalsSearch = Proposal::where('company', $postData['companySearch'])->first();
        $responseMessage = null;
  
          if($request->getMethod() == 'POST'){
              $postData = $request->getParsedBody();
              $proposalValidator = v::key('company', v::stringType()->notEmpty())
                            ->key('comment', v::stringType()->notEmpty());
  
              try{
                $proposalValidator->assert($postData);  
                $postData = $request->getParsedBody();

  
                $proposal = new Proposal();
                $proposal->company = $postData['company'];
                $proposal->comment = $postData['comment'];
                $proposal->save();
  
                $responseMessage = 'saved';
              } catch (\Exception $e) {
                $responseMessage = $e->getMessage();
              }            
              return new RedirectResponse('/feebulari/public/add');
            }
  
          //   include '../views/add-proposal.php';
           return $this->renderHTML('add-proposal.twig', [
            
            'proposals' => $proposals,
            'responseMessage'=>$responseMessage,
            'proposalsSearch' => $proposalsSearch
           ]);
  
          
          // location.reload();
      }
}


