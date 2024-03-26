<?php

class Debtors extends Controller
{
    protected object $debModel;
    protected object $tbDebModel;

    public function __construct()
    {
        $this->debModel = $this->model('Debtor', DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $this->tbDebModel = $this->model('Debtor', TB_DB_HOST, DB_NAME, TB_DB_USERNAME, TB_DB_PASSWORD);
    }

    public function index(): void
    {
        $debtors = $this->debModel->getAll();
        $this->view('debtors/index', $debtors);
    }

    public function debtor(int $inn)
    {
        $trade = $this->$debModel->getSingleTrade($inn);
        $tradeTb = $this->$tbDebModel->getSingleTrade($inn);

        if ($trade && $tradeTb) {
            $this->view('trades/trade', ['local' => $trade, 'remote' => $tradeTb]);
        } else {
            die("Должник с ИНН: $inn не найден в одной/обеих базах");
        }
    }
}