<?php
//create HTML form string


//include DB manager and UsersDAO
require_once('../slim/Slim/Slim.php');

require_once('DB/DAO/UsersDAO.php');
require_once('DB/DBManager.php');


\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array('debug' => true));


$app->get('/users/get', function () use ($app) {
      $db = new DBManager();
      $db->openConnection();

      $udao = new UsersDAO($db);

      $u = $udao->getUsers();

      $response = $app->response();
      $response['Content-Type'] = 'application/json';
      $response->body(json_encode($u));

});

$app->get('/users/insert', function () use ($app){
     $db = new DBManager();    
     $db->openConnection();    
     $udao = new UsersDAO($db);
        
     $inForm = "<html><form id='inUsers'>
        Name: <input type='text' name='name'/>
        Surname: <input type='text' name='surname' />
        Password: <input type='password' name='password' />
        Email: <input type='text' name='email' />
        Doit: <input type='submit' value='submit' /></form>     
     </html>";
     echo $inForm;
});


$app->get('/info', function() {
    echo phpinfo();
});

$app->run();
?>
