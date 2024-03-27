<?php

class Mess extends Model
{
    public function getSingleMess(string $url)
    {
        $this->db->query("SELECT * FROM mess WHERE url='$url'");
        return $this->db->getSingleRecord();
    }
}