<?php

class Trade
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllTrades(): array
    {
        return $this->db->getResult();
    }

    public function getRecentTrades(int $interval = 30)
    {
        $query = "SELECT * FROM torgi WHERE created >= NOW() - INTERVAL $interval SECOND";
        $result = $this->db->getResult($query);
        if (empty($result)) {
            return false;
        }
        return $result;
    }

    public function createLot(array $formdata): bool
    {
        $this->db->query('INSERT INTO trades (url, lot_number, content, initial_price, email, phone, debtor_inn, case_number, start_date) 
                          VALUES(:url, :lot_number, :content, :initial_price, :email, :phone, :debtor_inn, :case_number, :start_date)');
        $this->bindParams($formdata);


        return $this->db->execute();
    }

    public function updateLot(array $formdata, string $case_number, string $content): bool
    {
        $this->db->query('UPDATE trades SET url=:url,lot_number=:lot_number, content=:content, initial_price=:initial_price, 
                email=:email, phone=:phone, debtor_inn=:debtor_inn, 
                case_number=:case_number, start_date=:start_date
            WHERE case_number=:case_number AND lot_number=:lot_number');
        $this->bindParams($formdata);
        return $this->db->execute();
    }

    public function lotExists(string $case_number, string $lot_number): object
    {
        $this->db->query('SELECT * FROM trades WHERE 
                       case_number=:case_number AND lot_number=:lot_number');
        $this->db->bind(':case_number', $case_number);
        $this->db->bind(':lot_number', $lot_number);
        return $this->db->getSingleRecord();
    }

    private function bindParams(array $params): void
    {
        foreach ($params as $k => $v) {
            $this->db->bind(":$k", $v);
        }
    }
}