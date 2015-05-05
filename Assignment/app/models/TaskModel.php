<?php
require_once "DB/pdoDbManager.php";
require_once "DB/DAO/TasksDAO.php";
require_once "Validation.php";

/**
*
*/
class TaskModel{

    private $TasksDAO;      // list of DAOs used by this model
    private $dbmanager;     // dbmanager
    public $apiResponse;    // api response
    private $validationSuite;   //contains functions for validating inputs

    public function __construct() {
        $this->dbmanager = new pdoDbManager ();
        $this->TasksDAO = new TasksDAO ($this->dbmanager);
        $this->dbmanager->openConnection();
        $this->validationSuite = new Validation();
    }

    public function get_all_task_durations(){
        return $this->TasksDAO->get_all_task_durations();
    }

}

?>
