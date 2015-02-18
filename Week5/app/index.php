<?php
require_once "../Slim/Slim.php";
Slim\Slim::registerAutoloader ();

$app = new \Slim\Slim (); // slim run-time object

require_once "DB/DBManager.php";
require_once "DB/DAO/UsersDAO.php";
require_once "HTTPErrorCodes.php";

$dbmanager = new DBmanager ();
$usersDAO = new UsersDAO ( $dbmanager );

$app->map ( "/users/(:id)", function ($userID = null) use($app, $dbmanager, $usersDAO) {
	
	$body = $app->request->getBody (); // get the body of the HTTP request (from client)
	$decBody = json_decode ( $body, true ); // this transform the string into an associative array
	$httpMethod = $app->request->getMethod ();
	
	if (($userID == null) or is_numeric ( $userID )) {	
		$DBresponse = null;
		$dbmanager->openConnection ();
		
		switch ($httpMethod) {
			case "GET" :
				$DBresponse = $usersDAO->get ( $userID );
                $app->response->status(OK);
				break;
			case "POST" :
				$DBresponse = $usersDAO->insert ( $decBody );
                $app->response->status(CREATED);
				break;
			case "PUT" :
				$DBresponse = $usersDAO->update ( $decBody, $userID );
                $app->response->status(CREATED);
				break;
			case "DELETE" :
				$DBresponse = $usersDAO->delete ( $userID );

                $app->response->status(CREATED);
				break;
		}
	}
	// return response to client
	$app->response->write ( json_encode ( $DBresponse ) ); // this is the body of the response
	$dbmanager->closeConnection ();
	//TODO:we need to write also the response codes in the headers to send back to the client
} )->via ( "GET", "POST", "PUT", "DELETE" );

$app->run ();
?>
