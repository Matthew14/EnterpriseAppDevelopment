<?php
require_once "../Slim/Slim.php";
Slim\Slim::registerAutoloader ();

$app = new \Slim\Slim (); // slim run-time object

//include code
require_once "conf/config.inc.php";
require_once "DB/pdoDbManager.php";
require_once "DB/DAO/UsersDAO.php";

//create new instances
$dbmanager = new pdoDbManager ();
$usersDAO = new UsersDAO ( $dbmanager );

//create a new route for the collection users
//$app->map ( "/users/(:id)", function ($userID = null) use($app, $dbmanager, $usersDAO) {

$app->map ( "/users(/:id)", function ($userID=null) use($app, $dbmanager, $usersDAO) {
	// get the body of the HTTP request (from client)
	$body = $app->request->getBody (); 
	// this transform the string into an associative array
	$decBody = json_decode ( $body, true ); 
	$httpMethod = $app->request->getMethod ();
	
	$DBresponse = "something went wrong";
	
	if (($userID == null) or is_numeric ( $userID )) {		
		$dbmanager->openConnection ();
		switch ($httpMethod) {
			case "GET" :
				$DBresponse = $usersDAO->get ( $userID );
				break;
			case "POST" :
				$DBresponse = $usersDAO->insert ( $decBody );
				break;
			case "PUT" :
				$DBresponse = $usersDAO->update ( $decBody, $userID );
				break;
			case "DELETE" :
				$DBresponse = $usersDAO->delete ( $userID );
				break;
			default: 
		}
		$dbmanager->closeConnection ();
	}
	// return response to client
	$app->response->write ( json_encode ( $DBresponse ) ); // this is the body of the response
	//TODO:we need to write also the response codes in the headers to send back to the client
} )->via ( "GET", "POST", "PUT", "DELETE" );

$app->run ();
?>