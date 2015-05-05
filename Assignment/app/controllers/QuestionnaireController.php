<?php
require_once 'helpers.php';
class QuestionnaireController {
    private $slimApp;
    private $model;

    public function __construct($model, $action = null, $slimApp, $parameters = null) {
        $this->model = $model;
        $this->slimApp = $slimApp;

        if ($action != null)
            $this->getQuestionnaireInfo();

    }

    private function getQuestionnaireInfo(){
        $answer = $this->model->get_all_questionnaires();

        if ($answer != null) {

            $count = count($answer);
            $stdDeviationMWL = stdDev($answer, MWL_TOTAL_FIELD_NAME);
            $averageMWL = average($answer, MWL_TOTAL_FIELD_NAME);
            $stdDeviationRSME = stdDev($answer, RSME_FIELD_NAME);
            $averageRSME = average($answer, RSME_FIELD_NAME);


            $response = array(
                "number_of_tasks" => $count,
                "std_dev_mwl_total" => $stdDeviationMWL,
                "average_mwl_total" => $averageMWL,
                "std_dev_rsme" => $stdDeviationRSME,
                "average_rmse" => $averageRSME
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
