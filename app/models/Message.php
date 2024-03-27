<?php

class Message extends Model
{
    public function getSingleMessage(string $guid, int $lot)
    {
        $this->db->query("SELECT * FROM messages WHERE guid='$guid' AND lot=$lot");
        return $this->db->getSingleRecord();
    }
}