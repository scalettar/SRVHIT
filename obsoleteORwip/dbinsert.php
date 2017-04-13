<?php
require_once 'dbconfig.php';
class InsertData{
	const DB_HOST = $host;
	const DB_NAME = $dbname;
	const DB_USER = $username;
	const DB_PASSWORD = $password;

	private $conn = null;
	/**
	 * Open the database connection
	 */
	public function __construct(){
		// open database connection
		$connectionString = sprintf("mysql:host=%s;dbname=%s",
				InsertData::DB_HOST,
				InsertData::DB_NAME);
		try {
			$this->conn = new PDO($connectionString,
					InsertData::DB_USER,
					InsertData::DB_PASSWORD);

		} catch (PDOException $pe) {
			die($pe->getMessage());
		}
	}
	/**
	 * Insert a row into a table
	 * @return returns a PDOStatement object, or false on failure.
	 */
	public function insert(){

		$sql = "INSERT INTO tasks(subject,description,start_date,end_date)
				VALUES('Learn PHP MySQL Insert Dat', 'PHP MySQL Insert data into a table',2013-01-01,2013-01-01)";

		return $this->conn->exec($sql);
	}


	/**
	* insert a new task into the tasks table
	 * @param string $subject
	 * @param string $description
	 * @param string $startDate
	 * @param string $endDate
	 * @return mixed returns false on failure
	 */
	function insertSingleRow($subject,$description,$startDate,$endDate) {
		$task = array(':subject' => $subject,
					  ':description' => $description,
					  ':start_date' => $startDate,
					  ':end_date' => $endDate);

		$sql = 'INSERT INTO tasks(subject,description,start_date,end_date)
				VALUES(:subject,:description,:start_date,:end_date)';

		$q = $this->conn->prepare($sql);

		return $q->execute($task);
	}


	/**
	 * close the database connection
	 */
	public function __destruct() {
		// close the database connection
		$this->conn = null;
	}
}


$obj = new InsertData();

// if($obj->insert() !== false)
// 	echo 'A new task has been added successfully';
// else
// 	echo 'Error adding the task';


if($obj->insertSingleRow('MySQL PHP Insert Tutorial',
					  'MySQL PHP Insert using prepared statement',
					   '2013-01-01',
					   '2013-01-02') !== false)

	echo 'A new task has been added successfully';
else
	echo 'Error adding the task';
