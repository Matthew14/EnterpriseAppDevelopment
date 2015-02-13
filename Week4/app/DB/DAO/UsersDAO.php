<?php
/**
 * @author Luca + Matthew
 * definition of the User DAO (database access object)
 */
class UsersDAO {
	private $dbManager;
	
    function UsersDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}
	function getUsers() {
		$sql = "SELECT * ";
		$sql .= "FROM users ";
		$sql .= "ORDER BY users.name; ";

		$result = $this->dbManager->executeQuery ( $sql );
		$arrayOfResults = $this->dbManager->fetchResults ( $result );
		return $arrayOfResults;
	}

	function insertUser($p) {
        $sql = "INSERT INTO users (name, surname, email, password) VALUES ($p[name], $p[surname], $p[email], $p[password])";
        $this->dbManager->excecuteQuery($sql);        
	}
}

?>
