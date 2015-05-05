<?php
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

    private function average($data){
        $total = 0;
        $numAges = count($data);
        for ($i = 0; $i < $numAges; ++$i)
            $total+= $data[$i]["age"];
        return $total / $numAges;
    }

    private function stdDev($data){
        $average = $this->average($data);
        $numAges = count($data);

        $total = 0;

        for ($i = 0; $i < $numAges; ++$i)
            $total += pow($data[$i]["age"] - $average, 2);

        return sqrt($total/$numAges);
    }


    private function getUserAgeAverageAndStdDev(){
        $answer = $this->model->getUserAges();

        if ($answer != null) {

            $stdDeviation = $this->stdDev($answer);
            $average = $this->average($answer);

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
