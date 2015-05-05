<?php
require_once "DB/pdoDbManager.php";
require_once "DB/DAO/TasksDAO.php";

/**
* @author Matthew O'Neill / C11354316
* A model of Tasks
*/
class TaskModel{

    private $TasksDAO;      // list of DAOs used by this model
    private $dbmanager;     // dbmanager
    public $apiResponse;    // api response

    public function __construct() {
        $this->dbmanager = new pdoDbManager ();
        $this->TasksDAO = new TasksDAO ($this->dbmanager);
        $this->dbmanager->openConnection();
    }

    public function get_all_task_durations(){
        return $this->TasksDAO->get_all_task_durations();
    }

}

?>
