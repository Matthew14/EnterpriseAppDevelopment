<?php
/**
 * @author Luke
 * This class is a simple database manager for mysql
 */
class DBManager {
	private $connection; // contains the connection object
    private $mysqli;	
	/**
	 * step 1: open db connection
	 */
	function openConnection() {
		// root is the default mysql user
		// 'password' is the default password for user root
         $this->connection = mysqli_connect ( "localhost", "EAD", "eadPass", "ead" ) or die ( "Cannot establish connection" );
         $this->mysqli = new mysqli( "localhost", "EAD", "eadPass", "ead" );
	}
	/**
	 * step 2: perform a DML query (SQL in this case)
	 */
	function executeQuery($queryString) {
		$resultSet = mysqli_query ( $this->connection, $queryString ) or die ( "Syntax error in SQL statement" );
		return ($resultSet);
	}
	/**
	 * step 3: fetch results
	 */

    function preparedStatement($q, $parametersArray){

        $stmt = $this->mysqli->prepare($q);
        $stmt->bind_param( 'ssds',$n,  $parametersArray ["surname"],  $parametersArray ["password"],  $parametersArray ["email"]);
        $n = $parametersArray["name"];
        
        $stmt->execute();
        $stmt->close();
    }

	function fetchResults($resultSet) {
		$rows = array (); // will contain all the records
		while ( $row = $resultSet->fetch_array ( MYSQLI_ASSOC ) ) {
			$rows [] = $row;
		}
		return $rows;
	}
	/**
	 * step 4: close connection
	 */
	function closeConnection() {
		$this->connection->close ();
	}
	
	function getLastInsertedID(){
		return ($this->connection->insert_id);
	}
}

?>
