<?php
namespace App\Controllers;
use App\Models\Idea;
use App\Models\Person;
use App\Models\Search;
use Respect\Validation\Validator as v;
use Zend\Diactoros\Response\RedirectResponse;
// Use Cookie;

class CookieController extends BaseController {


    public function cookieInfo($request) {
     $hola= 'hey';
      
         return $this->renderHTML('cookie-info.twig', [         
         ]);
      
        // location.reload();
    }
}