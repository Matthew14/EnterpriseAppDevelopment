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
        $sql = "SELECT MWL_total, RSME, task_number, intrusiveness FROM questionnaire ";

        if($taskID != null)
            $sql .= "WHERE " . TASK_NUMBER_FIELD_NAME . "=?";

        $stmt = $this->dbManager->prepareQuery($sql);

        if($taskID != null)
            $this->dbManager->bindValue ($stmt, 1, $taskID, $this->dbManager->INT_TYPE);

        $this->dbManager->executeQuery($stmt);

        $rows = $this->dbManager->fetchResults($stmt);

        return $rows;
    }

}

?>
