<?php
class TaskController {
    private $slimApp;
    private $model;

    public function __construct($model, $action = null, $slimApp, $parameters = null) {
        $this->model = $model;
        $this->slimApp = $slimApp;

        if ($action != null)
            $this->getTaskInfo();

    }

    private function average($data){
        $total = 0;
        $numTasks = count($data);
        for ($i = 0; $i < $numTasks; ++$i)
            $total+= $data[$i]["duration_mins"];
        return $total / $numTasks;
    }

    private function stdDev($data){
        $average = $this->average($data);
        $numTasks = count($data);

        $total = 0;

        for ($i = 0; $i < $numTasks; ++$i)
            $total += pow($data[$i]["duration_mins"] - $average, 2);

        return sqrt($total/$numTasks);
    }


    private function getTaskInfo(){
        $answer = $this->model->get_all_task_durations();

        if ($answer != null) {

            $count = count($answer);
            $stdDeviation = $this->stdDev($answer);
            $average = $this->average($answer);

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
