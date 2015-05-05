<?php
require_once 'helpers.php';

class TaskController {
    private $slimApp;
    private $model;

    public function __construct($model, $action = null, $slimApp, $parameters = null) {
        $this->model = $model;
        $this->slimApp = $slimApp;

        if ($action != null)
            $this->getTaskInfo();

    }

    private function getTaskInfo(){
        $answer = $this->model->get_all_task_durations();

        if ($answer != null) {

            $count = count($answer);
            $stdDeviation = stdDev($answer, "duration_mins");
            $average = average($answer, "duration_mins");

            $response = array(
                "number_of_tasks" => $count,
                "std_dev_duration" => $stdDeviation,
                "average_duration" => $average,
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
