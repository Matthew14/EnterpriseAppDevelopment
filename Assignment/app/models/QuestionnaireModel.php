<?php
require_once "DB/pdoDbManager.php";
require_once "DB/DAO/QuestionnairesDAO.php";

/**
* @author Matthew O'Neill / C11354316
* Model representing Questionnaire
*/
class QuestionnaireModel{

    private $QuestionnairesDAO;      // list of DAOs used by this model
    private $dbmanager;     // dbmanager
    public $apiResponse;    // api response

    public function __construct() {
        $this->dbmanager = new pdoDbManager ();
        $this->QuestionnairesDAO = new QuestionnairesDAO ($this->dbmanager);
        $this->dbmanager->openConnection();
    }

    public function get_all_questionnaires(){
        return $this->QuestionnairesDAO->get_all_questionnaires();
    }

    public function get_questionnaires_by_task($taskID){
        return $this->QuestionnairesDAO->get_all_questionnaires($taskID);
    }

}

?>
