<?php
require_once "DB/pdoDbManager.php";
require_once "DB/DAO/StudentsDAO.php";
require_once "Validation.php";

/**
*
*/
class StudentModel{

    private $StudentsDAO;      // list of DAOs used by this model
    private $dbmanager;     // dbmanager
    public $apiResponse;    // api response
    private $validationSuite;   //contains functions for validating inputs

    public function __construct() {
        $this->dbmanager = new pdoDbManager ();
        $this->StudentsDAO = new StudentsDAO ($this->dbmanager);
        $this->dbmanager->openConnection();
        $this->validationSuite = new Validation();
    }

    public function getStudentAges(){
        return $this->StudentsDAO->get_all_ages();
    }

    public function getStudentAgesByNationality($nationality){
        return $this->StudentsDAO->get_all_ages_by_nationality($nationality);

    }
}

?>
