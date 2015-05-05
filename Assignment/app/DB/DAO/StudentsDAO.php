<?php

/**
 * @author Matthew O'Neill / C11354316
 * A DAO providing methods relating to students
 */

class StudentsDAO{
    private $dbManager;

    function StudentsDAO($dbManager){
        $this->dbManager = $dbManager;
    }

    public function get_all_ages(){
        $sql = "SELECT age FROM students";

        $stmt = $this->dbManager->prepareQuery($sql);
        $this->dbManager->executeQuery($stmt);

        $rows = $this->dbManager->fetchResults($stmt);

        return $rows;
    }
}

?>
