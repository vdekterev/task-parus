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
        $this->db->bind(':url', $formdata['url']);
        $this->db->bind(':lot_number', $formdata['lot_number']);
        $this->db->bind(':content', $formdata['content']);
        $this->db->bind(':initial_price', $formdata['initial_price']);
        $this->db->bind(':email', $formdata['email']);
        $this->db->bind(':phone', $formdata['phone']);
        $this->db->bind(':debtor_inn', $formdata['debtor_inn']);
        $this->db->bind(':case_number', $formdata['case_number']);
        $this->db->bind(':start_date', $formdata['start_date']);

        return $this->db->execute();
    }

    public function updateLot(array $formdata, string $case_number, string $content): bool
    {
        $this->db->query('UPDATE lots SET url=:url,lot_number=:lot_number, content=:content, initial_price=:initial_price, 
                email=:email, phone=:phone, debtor_inn=:debtor_inn, 
                case_number=:case_number, start_date=:start_date
            WHERE content=:content AND case_number=:case_number');
        $this->db->bind(':url', $formdata['url']);
        $this->db->bind(':lot_number', $formdata['lot_number']);
        $this->db->bind(':content', $formdata['content']);
        $this->db->bind(':initial_price', $formdata['initial_price']);
        $this->db->bind(':email', $formdata['email']);
        $this->db->bind(':phone', $formdata['phone']);
        $this->db->bind(':debtor_inn', $formdata['debtor_inn']);
        $this->db->bind(':case_number', $formdata['case_number']);
        $this->db->bind(':start_date', $formdata['start_date']);
        return $this->db->execute();
    }

    public function lotExists(string $case_number, string $content): object|bool
    {
        $this->db->query('SELECT * FROM lots WHERE case_number = :case_number AND content = :content');
        $this->db->bind(':case_number', $case_number);
        $this->db->bind(':content', $content);
        return $this->db->getSingleRecord();
    }


}