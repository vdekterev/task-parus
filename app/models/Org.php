<?php

class Org extends Model
{
    public function getSingleOrg(string $inn) {
        $this->db->query("SELECT * FROM org WHERE inn=$inn");
        return $this->db->getSingleRecord();
    }
}