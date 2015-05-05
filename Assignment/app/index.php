<?php

/*
    Author: Matthew O'Neill / C11354316
    Enterprise Application Development Assignment

*/

require_once "../Slim/Slim.php";
require_once "conf/config.inc.php";

Slim\Slim::registerAutoloader ();

function authenticate(\Slim\Route $route){


}

$jsonMIME = "application/json";
$xmlMIME = "application/xml";

$app = new \Slim\Slim (); // slim run-time object

//Route 1 and 2
$app->map("/statistics/students(/:nationality)", function($nationality = null) use($app){

    $params = null;
    $model = "StudentModel";
    $controller = "StudentController";
    $reqType = $app->request->headers->get('Accept');

    if($reqType != XML_MIME && $reqType != JSON_MIME)
        $reqType = JSON_MIME;

    $app->response->headers->set("Content-Type", $reqType);

    $view = $reqType == XML_MIME ? "xmlView" : "jsonView";

    if($nationality == null)
        $action = ACTION_GET_STUDENTS_STATS;

    else{
        $action = ACTION_GET_STUDENTS_STATS_BY_NATIONALITY;
        $params = $nationality;
    }

    return new loadRunMVCComponents($model, $controller, $view, $action, $app, $params);

})->via("GET");


//Route 3
$app->map("/statistics/tasks", function() use($app){

    $params = null;
    $model = "TaskModel";
    $controller = "TaskController";
    $reqType = $app->request->headers->get('Accept');

    if($reqType != XML_MIME && $reqType != JSON_MIME)
        $reqType = JSON_MIME;

    $app->response->headers->set("Content-Type", $reqType);
    $view = $reqType == XML_MIME ? "xmlView" : "jsonView";
    $action = ACTION_GET_TASKS_INFO;

    return new loadRunMVCComponents($model, $controller, $view, $action, $app, $params);

})->via("GET");


//Route 4 and 5
$app->map("/statistics/questionnaires(/:taskID)", function($taskID = null) use($app){

    $params = null;
    $model = "QuestionnaireModel";
    $controller = "QuestionnaireController";
    $reqType = $app->request->headers->get('Accept');

    if($reqType != XML_MIME && $reqType != JSON_MIME)
        $reqType = JSON_MIME;

    $app->response->headers->set("Content-Type", $reqType);

    $view = $reqType == XML_MIME ? "xmlView" : "jsonView";

    if($taskID == null){
        $action = ACTION_GET_QUESTIONNAIRES_INFO;
    }
    else{
         $action = ACTION_GET_QUESTIONNAIRES_INFO_BY_TASK;
    }

})->via("GET");

$app->map ( "/users(/:id)", function ($userID = null) use($app) {

    $httpMethod = $app->request->getMethod();
    if (($userID == null) or is_numeric ( $userID )) {
        $parameters["id"] = $userID;        //prepare parameters to be passed to the controller (example: ID)
        switch ($httpMethod) {
            case "GET" :
                if ($userID != null)
                    $action = ACTION_GET_USER;
                else
                    $action = ACTION_GET_USERS;
                break;
            case "POST" :
                $action = ACTION_CREATE_USER;
                break;
            case "PUT" :
                $action = ACTION_UPDATE_USER;
                break;
            case "DELETE" :
                $action = ACTION_DELETE_USER;
                break;
            default :
        }
    }

    return new loadRunMVCComponents ( "UserModel", "UserController", "jsonView", $action, $app, $parameters );

} )->via ( "GET", "POST", "PUT", "DELETE" );

$app->run ();

class loadRunMVCComponents {
    public $model, $controller, $view;
    public function __construct($modelName, $controllerName, $viewName, $action, $app, $parameters = null) {
        include_once "models/" . $modelName . ".php";
        include_once "controllers/" . $controllerName . ".php";
        include_once "views/" . $viewName . ".php";

        $this->model = new $modelName (); // common model
        $this->controller = new $controllerName ( $this->model, $action, $app, $parameters );
        $this->view = new $viewName ( $this->controller, $this->model, $app ); // common view
        $this->view->output(); // this returns the response to the requesting client
    }
}

?>
