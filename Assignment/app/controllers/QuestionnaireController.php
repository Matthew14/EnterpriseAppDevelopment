<?php
require_once 'helpers.php';

/**
 * @author Matthew O'Neill / C11354316
 * Controller for operations involving Questionnaires
 */
class QuestionnaireController {
    private $slimApp;
    private $model;

    public function __construct($model, $action = null, $slimApp, $parameters = null) {
        $this->model = $model;
        $this->slimApp = $slimApp;

        if ($action != null)
            $parameters == null ? $this->getQuestionnaireInfo() : $this->getQuestionnaireInfoForTask($parameters["taskID"]);

    }

    private function getQuestionnaireInfoForTask($taskId){
        $answer = $this->model->get_questionnaires_by_task($taskId);
        if ($answer != null) {

            $count = count($answer);
            $stdDeviationMWL = stdDev($answer, MWL_TOTAL_FIELD_NAME);
            $averageMWL = average($answer, MWL_TOTAL_FIELD_NAME);
            $stdDeviationRSME = stdDev($answer, RSME_FIELD_NAME);
            $averageRSME = average($answer, RSME_FIELD_NAME);
            $stdDeviationIntrusiveness = stdDev($answer, RSME_FIELD_NAME);
            $averageIntrusiveness = average($answer, RSME_FIELD_NAME);

            $response = array(
                "number_of_tasks" => $count,
                "std_dev_mwl_total" => $stdDeviationMWL,
                "average_mwl_total" => $averageMWL,
                "std_dev_rsme" => $stdDeviationRSME,
                "average_rmse" => $averageRSME,
                "std_dev_intrusiveness" => $stdDeviationIntrusiveness,
                "average_intrusiveness" => $averageIntrusiveness
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
