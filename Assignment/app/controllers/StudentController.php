<?php
require_once 'helpers.php';

class StudentController {
    private $slimApp;
    private $model;

    public function __construct($model, $action = null, $slimApp, $parameters = null) {
        $this->model = $model;
        $this->slimApp = $slimApp;

        if ($action != null) {
            switch ($action) {
                case ACTION_GET_STUDENTS_STATS :
                    $this->getUserAgeAverageAndStdDev();
                    break;
                case ACTION_GET_STUDENTS_STATS_BY_NATIONALITY :

                    $nationality = $parameters["nationality"];
                    $this->getUserAgeAverageAndStdDev($nationality);
                    break;
                default : break;
            }
        }
    }

    private function getUserAgeAverageAndStdDev($nationality = null){
        $answer = $nationality == null ? $this->model->getStudentAges() : $this->model->getStudentAgesByNationality($nationality);

        if ($answer != null) {

            $stdDeviation = stdDev($answer, "age");
            $average = average($answer, "age");

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
