<?php

class Trade extends Model
{

    public function getRecentTrades(int $interval = 30)
    {
        $query = "SELECT * FROM torgi WHERE created >= NOW() - INTERVAL $interval SECOND";
        $result = $this->db->getResult($query);
        if (empty($result)) {
            return false;
        }
        return $result;
    }

    public function getSingleTrade(string $guid, int $lot)
    {
        $this->db->query("SELECT * FROM torgi WHERE guid='$guid' AND lot=$lot");
//        $this->db->bind(':guid', $guid);
//        $this->db->bind(':lot', $lot);
        return $this->db->getSingleRecord();
    }

}