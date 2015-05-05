<?php

/**
 * @author Matthew O'Neill / C11354316
 * A DAO providing methods relating to questionnaires
 */

class QuestionnairesDAO{
    private $dbManager;

    function QuestionnairesDAO($dbManager){
        $this->dbManager = $dbManager;
    }

    public function get_all_questionnaires($taskID = null){
        $sql = "SELECT MWL_total, RSME, task_number, intrusiveness FROM questionnaire";


        $stmt = $this->dbManager->prepareQuery($sql);
        $this->dbManager->executeQuery($stmt);

        $rows = $this->dbManager->fetchResults($stmt);

        return $rows;
    }

}

?>
