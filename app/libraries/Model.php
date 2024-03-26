<?php

abstract class Model
{
    protected Database $db;

    public function __construct(string $host, string $dbname, string $username, string $password)
    {
        $this->db = new Database($host, $dbname, $username, $password);
    }

    public function getAll(): array
    {
        return $this->db->getResult();
    }
    protected function bindParams(array $params): void
    {
        foreach ($params as $k => $v) {
            $this->db->bind(":$k", $v);
        }
    }
}