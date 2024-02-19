<?php

namespace models;

use Database;

class Lot
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function createLot(array $formdata): bool
    {
        $this->db->query('INSERT INTO lots (url, content, initial_price, email, phone, inn, case_number, start_date) 
                          VALUES(:url, :content, :initial_price, :email, :inn, :case_number, :start_date)');
        $this->db->bind(':url', $formdata['url']);
        $this->db->bind(':content', $formdata['content']);
        $this->db->bind(':initial_price', $formdata['initialPrice']);
        $this->db->bind(':email', $formdata['email']);
        $this->db->bind(':phone', $formdata['phone']);
        $this->db->bind(':inn', $formdata['inn']);
        $this->db->bind(':case_number', $formdata['caseNumber']);
        $this->db->bind(':startDate', $formdata['start_date']);

        return $this->db->execute();
    }
}