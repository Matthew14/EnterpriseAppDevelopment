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

    public function get_all_ages_by_nationality($nat){
        $sql = "SELECT age from students s join nationalities n on n.id = s.id_nationality where lower(n.description) LIKE ?";

        $stmt = $this->dbManager->prepareQuery($sql);
        $this->dbManager->bindValue ($stmt, 1, strtolower($nat), $this->dbManager->STRING_TYPE);
        $this->dbManager->executeQuery($stmt);
        $rows = $this->dbManager->fetchResults($stmt);

        return $rows;

    }
}

?>
