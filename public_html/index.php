<!-- front controler -->
<?php
// método para php muestre los errores
ini_set('display_errors', 1);
ini_set('display_starup_error', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
// esta linea  de password  falta desarrollarla con forme a la documentación.
// password_hash('superSecurePaswd', PASSWORD_DEFAULT);

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// echo getenv(DB_HOST);

// Illuminate es un ORM de estilo ActiveRecord y un generador de esquemas.
use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;
// use App\Models\{Proposal, Project};
// require_once '../proposals.php';
// require_once '../add-proposal.php';


$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => getenv('DB_HOST'),
    'database'  => getenv('DB_NAME'),
    'username'  => getenv('DB_USER'),
    'password'  => getenv('DB_PASS'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

// PSR-7 HTTP message implementations
$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

// $route = $_GET['route'] ?? '/';
// if ($route == '/'){
//     require_once '../proposals.php';
// }elseif ($route == 'addProposal'){
//     require_once '../add-proposal.php';
// }
$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();
// $map->get('index',  '/feebulari/public', [
//     'controller' => 'App\Controllers\IndexController', 
//     'action' => 'IndexAction']);
$map->get('index', '/', [
    'controller' => 'App\Controllers\IdeasController', 
    'action' => 'getAddIdeaAction']); 
// $map->post('saveProposals', '/feebulari/public/add', [
//     'controller' => 'App\Controllers\ProposalsController', 
//     'action' => 'getAddProposalAction']); 


$map->post('saveIdeas', '/', [
        'controller' => 'App\Controllers\IdeasController', 
        'action' => 'postSearch'
        ]); 

        // $map->get('sitemap', '/sitemap', [
        //     'controller' => 'App\Controllers\SitemapControler', 
        //     'action' => 'getSitemap']); 

$map->get('addUser', '/feebulari/public_html/users/add', [
        'controller' => 'App\Controllers\UsersController',
        'action' => 'getAddUser'
    ]); 
// ******************************************************************** prueba 
$map->get('searchUser', '/feebulari/public_html/users/search', [
        'controller' => 'App\Controllers\SearchToController',
        'action' => 'getSearchUser'
    ]);
$map->post('UserSearch', '/feebulari/public_html/users/search', [
        'controller' => 'App\Controllers\SearchToController',
        'action' => 'postSearchUser'
    ]); 
//******************************************************************** */
$map->post('saveUser', '/feebulari/public_html/users/save', [
        'controller' => 'App\Controllers\UsersController',
        'action' => 'postSaveUser'
    ]);   
$map->get('loginForm', '/feebulari/public_html/login', [
        'controller' => 'App\Controllers\AuthController',
        'action' => 'getLogin'
    ]);  
$map->get('logout', '/feebulari/public_html/logout', [
        'controller' => 'App\Controllers\AuthController',
        'action' => 'getLogout'
    ]);
$map->post('auth', '/feebulari/public_html/auth', [
        'controller' => 'App\Controllers\AuthController',
        'action' => 'postLogin'
    ]);
$map->get('admin', '/feebulari/public_html/admin', [
        'controller' => 'App\Controllers\AdminController',
        'action' => 'getIndex',
        'auth' => true
    ]); 
// $map->get('search', '/feebulari/public/add', [
//         'controller' => 'App\Controllers\ProposalsController',
//          'action' => 'getSearch'
//      ]);    
// $map->post('search', '/feebulari/public/add', [
//        'controller' => 'App\Controllers\ProposalsController',
//         'action' => 'getSearch'
//     ]);
// $map->post('addProposalsDone', '/feebulari/public/add', '../add-proposal.php'); 




$matcher = $routerContainer->getMatcher();

$route = $matcher->match($request);



if (!$route) {
    echo 'NO route';
    
} else {
    $handlerData = $route->handler;
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];
    $needsAuth = $handlerData['auth'] ?? false;

    $sessionUserId = $_SESSION['userId'] ?? null;
    if($needsAuth && !$sessionUserId){
        echo 'Protected route';
        die;
    }

    $controller = new $controllerName;
    $response = $controller->$actionName($request);

    foreach($response->getHeaders() as $name => $values){
         foreach($values as $value) {
             header(sprintf('%s: %s', $name, $value), false);
         }
    }
    // response formato PSR7
    http_response_code($response->getStatusCode());
    echo $response->getBody();
  
}
