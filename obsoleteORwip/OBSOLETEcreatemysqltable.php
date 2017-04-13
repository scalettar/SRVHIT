<?php
require_once 'dbconfig.php';
class CreateTable {
    const DB_HOST = $host;
    const DB_NAME = $dbname;
    const DB_USER = $username;
    const DB_PASSWORD = $password;
    /**
     *
     * @var type
     */
    private $pdo = null;
    /**
     * Open the database connection
     */
    public function __construct() {
        // open database connection
        $conStr = sprintf("mysql:host=%s;dbname=%s", self::DB_HOST, self::DB_NAME);
        try {
            $this->pdo = new PDO($conStr, self::DB_USER, self::DB_PASSWORD);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    /**
     * close the database connection
     */
    public function __destruct() {
        // close the database connection
        $this->pdo = null;
    }

    /**
     * create the tasks table
     * @return boolean returns true on success or false on failure
     */
    public function createUserTable() {
        $sql = <<<EOSQL
            CREATE TABLE IF NOT EXISTS users (
                userId     INT AUTO_INCREMENT PRIMARY KEY,
                userName        VARCHAR (255)        DEFAULT NULL,
                userImage       VARCHAR (255)        DEFAULT NULL,
                userEmail       VARCHAR (255)        DEFAULT NULL,
                userTraits      VARCHAR (255)        DEFAULT NULL,
                userDescription VARCHAR (400)        DEFAULT NULL
            );
EOSQL;
        return $this->pdo->exec($sql);
    }

}
// create user table
$obj = new CreateTable();
$obj->createUserTable();
?>
