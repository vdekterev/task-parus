<?php

class Arbitr extends Model
{
    public function getSingleArbitr(string $inn) {
        $this->db->query("SELECT * FROM arbitr WHERE inn=$inn");
        return $this->db->getSingleRecord();
    }
}