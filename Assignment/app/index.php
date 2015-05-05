<?php

/**
 *   Enterprise Application Development Assignment
 *   @author Matthew O'Neill / C11354316
*/

require_once "../Slim/Slim.php";
require_once "conf/config.inc.php";

Slim\Slim::registerAutoloader ();


/**
 * Checks headers against the configured username and password as there is no user
 * table in the database
 * @param Route $route the route that has been requested
 */

$app = new \Slim\Slim (); // slim run-time object
function authenticate(\Slim\Route $route) {
    $slim = \Slim\Slim::getInstance();
    $reqUsername = $slim->request->headers->get(HTTP_HEADER_USERNAME);
    $reqPassword = $slim->request->headers->get(HTTP_HEADER_PASSWORD);

    if($reqUsername == null || $reqPassword == null)
        $slim->halt(HTTPSTATUS_UNAUTHORIZED, GENERAL_MESSAGE_CREDS_NOT_GIVEN);

    if($reqUsername != USERNAME)
        $slim->halt(HTTPSTATUS_UNAUTHORIZED, INVALID_USERNAME);

    if($reqPassword != PASSWORD)
        $slim->halt(HTTPSTATUS_UNAUTHORIZED, INVALID_PASSWORD);
}

//Route 1 and 2
$app->map("/statistics/students(/:nationality)", "authenticate", function($nationality = null) use($app){

    $params = null;
    $model = "StudentModel";
    $controller = "StudentController";
    $reqType = $app->request->headers->get(HTTP_HEADER_ACCEPT);

    if($reqType != XML_MIME && $reqType != JSON_MIME)
        $reqType = JSON_MIME;

    $app->response->headers->set(HTTP_HEADER_CONTENT_TYPE, $reqType);

    $view = $reqType == XML_MIME ? "xmlView" : "jsonView";

    if($nationality == null)
        $action = ACTION_GET_STUDENTS_STATS;

    else{
        $action = ACTION_GET_STUDENTS_STATS_BY_NATIONALITY;
        $params = array("nationality" => $nationality);
    }

    return new loadRunMVCComponents($model, $controller, $view, $action, $app, $params);

})->via(HTTP_GET);


//Route 3
$app->map("/statistics/tasks", "authenticate", function() use($app){

    $params = null;
    $model = "TaskModel";
    $controller = "TaskController";
    $reqType = $app->request->headers->get(HTTP_HEADER_ACCEPT);

    if($reqType != XML_MIME && $reqType != JSON_MIME)
        $reqType = JSON_MIME;

    $app->response->headers->set(HTTP_HEADER_CONTENT_TYPE, $reqType);
    $view = $reqType == XML_MIME ? "xmlView" : "jsonView";
    $action = ACTION_GET_TASKS_INFO;

    return new loadRunMVCComponents($model, $controller, $view, $action, $app, $params);

})->via(HTTP_GET);


//Route 4 and 5
$app->map("/statistics/questionnaires(/:taskID)", "authenticate", function($taskID = null) use($app){

    $params = null;
    $model = "QuestionnaireModel";
    $controller = "QuestionnaireController";
    $reqType = $app->request->headers->get(HTTP_HEADER_ACCEPT);

    if($reqType != XML_MIME && $reqType != JSON_MIME)
        $reqType = JSON_MIME;

    $app->response->headers->set(HTTP_HEADER_CONTENT_TYPE, $reqType);

    $view = $reqType == XML_MIME ? "xmlView" : "jsonView";

    if($taskID == null){
        $action = ACTION_GET_QUESTIONNAIRES_INFO;
    }
    else{
         $action = ACTION_GET_QUESTIONNAIRES_INFO_BY_TASK;
         $params = array('taskID' => $taskID);
    }
    return new loadRunMVCComponents($model, $controller, $view, $action, $app, $params);

})->via(HTTP_GET);


$app->run();

class loadRunMVCComponents {
    public $model, $controller, $view;
    public function __construct($modelName, $controllerName, $viewName, $action, $app, $parameters = null) {
        include_once MODEL_FOLDER . $modelName . ".php";
        include_once CONTROLLER_FOLDER . $controllerName . ".php";
        include_once VIEW_FOLDER . $viewName . ".php";

        $this->model = new $modelName (); // common model
        $this->controller = new $controllerName ( $this->model, $action, $app, $parameters );
        $this->view = new $viewName ( $this->controller, $this->model, $app ); // common view
        $this->view->output(); // this returns the response to the requesting client
    }
}

?>
