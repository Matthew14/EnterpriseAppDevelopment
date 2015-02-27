<?php
/**
 * @author Luca
 * definition of the User DAO (database access object)
 */
class UsersDAO {
	private $dbManager;
	function UsersDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}
	
	//This is using the new PDO db manager and it is an example
	function get($id) {
		$sql = "SELECT * ";
			$sql .= "FROM users ";
			if ($id != null)
				$sql .= "WHERE users.id=:id ";
			$sql .= "ORDER BY users.name ";
			
		$stmt = $this->dbManager->prepareQuery($sql);
		
		$this->dbManager->bindValue($stmt, ':id', $id, $this->dbManager->INT_TYPE);		
		$this->dbManager->executeQuery($stmt);
		
		$rows = $this->dbManager->fetchResults($stmt);
		return ($rows);
	}
	
	function insert($parametersArray) {
	    $sql = "INSERT INTO users (name, surname, email, password) VALUES (:name, :surname, :email, :password)";
        
        $stmt = $this->dbManager->prepareQuery($sql);

        $this->dbManager->bindValue($stmt, ':name', $parametersArray['name'], $this->dbManager->INT_TYPE); 	
        $this->dbManager->bindValue($stmt, ':surname', $parametersArray['surname'], $this->dbManager->INT_TYPE);
        $this->dbManager->bindValue($stmt, ':email', $parametersArray['email'], $this->dbManager->INT_TYPE);
        $this->dbManager->bindValue($stmt, ':password', $parametersArray['password'], $this->dbManager->INT_TYPE);

        $this->dbManager->executeQuery($stmt);


	}
	function update($parametersArray, $userID) {
        $sql = "UPDATE users SET name = :name, surname = :surname, email = :email, password = :password WHERE id = :id";
        
        echo $parametersArray['name'];

        $stmt = $this->dbManager->prepareQuery($sql);
        $this->dbManager->bindValue($stmt, ':name', $parametersArray['name'], $this->dbManager->INT_TYPE);        		
        $this->dbManager->bindValue($stmt, ':surname', $parametersArray['surname'], $this->dbManager->INT_TYPE);
        $this->dbManager->bindValue($stmt, ':email', $parametersArray['email'], $this->dbManager->INT_TYPE);
        $this->dbManager->bindValue($stmt, ':password', $parametersArray['password'], $this->dbManager->INT_TYPE);
        $this->dbManager->bindValue($stmt, ':id', $userID, $this->dbManager->INT_TYPE);

        $this->dbManager->executeQuery($stmt);

        return $this->dbManager->fetchResults($stmt);
	}
	function delete($userID) {
        $sql = "DELETE FROM users where id LIKE :id";
        $stmt = $this->dbManager->prepareQuery($sql);
        $this->dbManager->bindValue($stmt, ':id', $userID, $this->dbManager->INT_TYPE);
        $this->dbManager->executeQuery($stmt);

        return $this->dbManager->fetchResults($stmt);
	}
}
?>
