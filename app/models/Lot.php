<?php

class Lot
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllLots(): array
    {
        return $this->db->getResult();
    }

    public function createLot(array $formdata): bool
    {
        $this->db->query('INSERT INTO lots (url, lot_number, content, initial_price, email, phone, debtor_inn, case_number, start_date) 
                          VALUES(:url, :lot_number, :content, :initial_price, :email, :phone, :debtor_inn, :case_number, :start_date)');
        $this->bindParams($formdata);


        return $this->db->execute();
    }

    public function updateLot(array $formdata, string $case_number, string $content): bool
    {
        $this->db->query('UPDATE lots SET url=:url,lot_number=:lot_number, content=:content, initial_price=:initial_price, 
                email=:email, phone=:phone, debtor_inn=:debtor_inn, 
                case_number=:case_number, start_date=:start_date
            WHERE case_number=:case_number AND lot_number=:lot_number');
        $this->bindParams($formdata);
        return $this->db->execute();
    }

    public function lotExists(string $case_number, string $lot_number): object|bool
    {
        $this->db->query('SELECT * FROM lots WHERE 
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