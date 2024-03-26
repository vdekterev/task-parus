<?php

class Debtor extends Model
{
    public function getSingleDebtor(string $inn) {
        $this->db->query('SELECT * FROM debtor WHERE inn=:inn');
        $this->db->bind(':inn', $inn);
        return $this->db->getSingleRecord();
    }
}