<?php
/**
 * @author luca
 * an implementation of a database manager usng the PDO php object
 */

//require_once '../conf/config.inc.php';

class pdoDbManager{

	private $db_link;
	private $hostname = DB_HOST;
	private $username = DB_USER;
   	private $password = DB_PASS;
    private $dbname = DB_NAME;
	private $charset = DB_CHARSET;
	private $debugMode = DB_DEBUGMODE;
	private $dbVendor = DB_VENDOR; 

	public $INT_TYPE = PDO::PARAM_INT;
	public $STRING_TYPE = PDO::PARAM_STR;
	
    function __construct(){
        $this->db_link = new PDO("$this->dbVendor:host=$this->hostname;dbname=$this->dbname;charset=$this->charset", $this->username, $this->password);
	}

	function openConnection(){
		
    }	

	function prepareQuery($query){
        return $this->db_link->prepare($query);
	}

	function bindValue($stmt, $pos, $value, $type){
        $stmt->bindValue($pos, $value, $type);
    }

	function executeQuery($stmt){
	    return $stmt->execute();
    }

	function fetchResults($stmt){

		$r = $stmt->fetch();
        return $r;
	}

	function getNextRow($stmt){
        return $stmt->fetch();		
	}

	function closeConnection(){
        $this->db_link = null;
	}
    
}

$p = new  pdoDbManager();
?>
