<?php
namespace App\Controllers;
use App\Models\User;
use Respect\Validation\Validator as v;
use Zend\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController {
    public function getLogin() {
        return $this->renderHTML('login.twig');
    }

    public function postLogin($request) {
        $postData = $request->getParsedBody();
        $responseMessage = null;
    //    Aqui se valida si es valido ese usario y contraseña por medio de Eloquent (ORM)
     $user = User::where('email', $postData['email'])->first();
    //  La linea anterior quiere decir: busca dentro de la tabla user un email que sea igual a $postData['email']) y traeme el primero que te encuetres, solo uno 
  if($user){
        if(password_verify($postData['password'], $user->password)) {
            // consultamos nuestro user, verificamos el password y si es correcto establecemos el userId
            $_SESSION['userId'] = $user->id;
           return new RedirectResponse('/feebulari/public_html/admin');
        } else {
            $responseMessage = 'Bad credentials';
        }
  } else {
    $responseMessage = 'Bad credentials';
  }
    return $this->renderHTML('login.twig', [
        'responseMessage'=> $responseMessage
    ]);  
    }
    public function getLogout() {
        // uset() nos permite eliminar un elemento
        unset($_SESSION['userId']);
           return new RedirectResponse('/feebulari/public_html/login');
    }
}