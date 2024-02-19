<?php


/**
 * PDO Database Class
 *
 */

class Database
{
    /** credentials
     * @var string|mixed
     */
    private string $host = DB_HOST;
    /**
     * @var string|mixed
     */
    private string $username = DB_USERNAME;
    /**
     * @var string|mixed
     */
    private string $password = DB_PASSWORD;
    /**
     * @var string|mixed
     */
    private string $dbname = DB_NAME;

    /**
     * @var PDO
     */
    private PDO $dbh; // Database Handler
    /**
     * @var PDOStatement
     */
    private PDOStatement $stmt; // Statement
    /**
     * @var string
     */
    private string $error;

    public function __construct()
    {
        // Set DSN (Data Source Name)
        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
        $options = array(
            PDO::ATTR_PERSISTENT => true, // checking if connection already established
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );
        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->username, $this->password);
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
    public function bind(string $param, mixed $value, int|null $type = null): void
    {
        if (is_null($type)) {
            $type = match (true) {
                is_int($value) => PDO::PARAM_INT,
                is_bool($value) => PDO::PARAM_BOOL,
                is_null($value) => PDO::PARAM_NULL,
                default => PDO::PARAM_STR,
            };
        }
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
     * @return array
     */
    public function getResult(): array
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Get single record as an object
     * @return object|false
     */
    public function getSingleRecord(): object|false
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