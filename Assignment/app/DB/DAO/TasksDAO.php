<?php

/**
 * @author Matthew O'Neill / C11354316
 * A DAO providing methods relating to tasks
 */

class TasksDAO{
    private $dbManager;

    function TasksDAO($dbManager){
        $this->dbManager = $dbManager;
    }

    public function get_all_task_durations(){
        $sql = "SELECT duration_mins FROM tasks";

        $stmt = $this->dbManager->prepareQuery($sql);
        $this->dbManager->executeQuery($stmt);

        $rows = $this->dbManager->fetchResults($stmt);

        return $rows;
    }
}

?>
