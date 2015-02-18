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
	function get($id) {
		$sql = "SELECT * ";
		$sql .= "FROM users ";
		if ($id != null)
			$sql .= "WHERE users.id='$id' ";
		$sql .= "ORDER BY users.name ";
	
		$result = $this->dbManager->executeQuery ( $sql );
		$arrayOfResults = $this->dbManager->fetchResults ( $result );
		return $arrayOfResults;
	}
	function insert($parametersArray) {

      
		$this->dbManager->preparedStatement("INSERT INTO users (name, surname, email, password) VALUES(?,?,?,?)", $parametersArray);
        return $this->dbManager->getLastInsertedID();	//return last inserte ID
	}

	function update($parametersArray, $userID) {
		/*$sql = "UPDATE users ";
		$sql .= "SET name='" . $parametersArray ["name"] . "', ";
		$sql .= "surname='" . $parametersArray ["surname"] . "', ";
		$sql .= "email='" . $parametersArray ["email"] . "', ";
		$sql .= "password='" . $parametersArray ["password"] . "' ";
		$sql .= "WHERE users.id='$userID';";

		$result = $this->dbManager->executeQuery ( $sql );
		return $result;*/

        $this->dbManager->preparedStatement("UPDATE users SET name = ?, surname = ?, email = ? password = ? WHERE id = ".$userID, $parametersArray);

        return $userId;
	}
	function delete($userID) {
		$sql = "DELETE FROM users ";
		$sql .= "WHERE users.id='$userID';";
		
		$result = $this->dbManager->executeQuery ( $sql );
		return $result;
	}
}
?>
