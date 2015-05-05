<?php
require_once 'helpers.php';

class StudentController {
    private $slimApp;
    private $model;

    public function __construct($model, $action = null, $slimApp, $parameters = null) {
        $this->model = $model;
        $this->slimApp = $slimApp;

        $id = $parameters["id"];
        if ($action != null) {
            switch ($action) {
                case ACTION_GET_STUDENTS_STATS :
                    $this->getUserAgeAverageAndStdDev();
                    break;
                case ACTION_GET_STUDENTS_STATS_BY_NATIONALITY :
                    $this->getUsers ();
                    break;
                default : break;
            }
        }
    }

    private function getUserAgeAverageAndStdDev(){
        $answer = $this->model->getUserAges();

        if ($answer != null) {

            $stdDeviation = stdDev($answer);
            $average = average($answer);

            $response = array(
                "std_dev" => $stdDeviation,
                "average" => $average,
            );

            $this->slimApp->response ()->setStatus (HTTPSTATUS_OK);
            $this->model->apiResponse = $response;
        }
        else {
            $this->slimApp->response ()->setStatus (HTTPSTATUS_NOCONTENT);
            $Message = array (GENERAL_MESSAGE_LABEL => GENERAL_NOCONTENT_MESSAGE);
            $this->model->apiResponse = $Message;
        }
    }
}
?>
