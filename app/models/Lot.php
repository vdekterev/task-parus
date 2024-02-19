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
        $this->db->query('INSERT INTO lots (url, content, initial_price, email, phone, debtor_inn, case_number, start_date) 
                          VALUES(:url, :content, :initial_price, :email, :phone, :debtor_inn, :case_number, :start_date)');
        $this->db->bind(':url', $formdata['url']);
        $this->db->bind(':content', $formdata['content']);
        $this->db->bind(':initial_price', $formdata['initial_price']);
        $this->db->bind(':email', $formdata['email']);
        $this->db->bind(':phone', $formdata['phone']);
        $this->db->bind(':debtor_inn', $formdata['debtor_inn']);
        $this->db->bind(':case_number', $formdata['case_number']);
        $this->db->bind(':start_date', $formdata['start_date']);

        return $this->db->execute();
    }


    public function lotExists(string $id): object|bool
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':email', $email);
        return $this->db->getSingleRecord();
    }
}