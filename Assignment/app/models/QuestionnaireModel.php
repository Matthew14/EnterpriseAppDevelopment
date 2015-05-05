<?php
require_once "DB/pdoDbManager.php";
require_once "DB/DAO/QuestionnairesDAO.php";
require_once "Validation.php";

/**
*
*/
class QuestionnaireModel{

    private $QuestionnairesDAO;      // list of DAOs used by this model
    private $dbmanager;     // dbmanager
    public $apiResponse;    // api response
    private $validationSuite;   //contains functions for validating inputs

    public function __construct() {
        $this->dbmanager = new pdoDbManager ();
        $this->QuestionnairesDAO = new QuestionnairesDAO ($this->dbmanager);
        $this->dbmanager->openConnection();
        $this->validationSuite = new Validation();
    }

    public function get_all_questionnaires(){
        return $this->QuestionnairesDAO->get_all_questionnaires();
    }

    public function get_questionnaires_by_task($taskID){

    }

}

?>
