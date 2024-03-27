<?php


/**
 * PDO Database Class
 *
 */

class Database
{
    protected string $tableName;
    public PDO $dbh; // Database Handler
    /**
     * @var PDOStatement
     */
    public PDOStatement $stmt; // Statement
    /**
     * @var string
     */
    protected string $error;

    public function __construct(string $host, string $dbname, string $username, string $password, $tableName)
    {
        // Set DSN (Data Source Name)
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $this->tableName = $tableName;
        $options = array(
            PDO::ATTR_PERSISTENT => true, // checking if connection already established
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );
        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }


    /**
     * Prepare Query
     * @param string $sql
     * @return void
     */
    public function query(string $sql): void
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * Bind Value
     * @param string $param
     * @param mixed $value
     * @param int|null $type
     * @return void
     */
    public function bind(string $param, $value, int $type = null): void
    {
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Execute the statement
     * @return bool
     */
    public function execute(): bool
    {
        return $this->stmt->execute();
    }

    /**
     * Get result as an array of objects
     * @param string $query
     * @return array
     */
    public function getResult(string $query = ""): array
    {
        if (empty($query)) {
            $query = "SELECT * FROM $this->tableName ORDER BY $this->tableName.id DESC";
        }
        $this->query($query);
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Get single record as an object
     * @return object|false
     */
    public function getSingleRecord()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Get row count
     * @return int
     */
    public function getRowCount(): int
    {
        return $this->stmt->rowCount();
    }
}