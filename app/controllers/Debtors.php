<?php

class Debtors extends Controller
{
    protected object $debModel;
    protected object $tbDebModel;

    public function __construct()
    {
        $this->debModel = $this->model('Debtor', DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD, 'debtor');
        $this->tbDebModel = $this->model('Debtor', TB_DB_HOST, DB_NAME, TB_DB_USERNAME, TB_DB_PASSWORD, 'debtor');
    }

    public function index(): void
    {
        $debtors = $this->debModel->getAll();
        $this->view('debtors/index', $debtors);
    }

    public function debtor(int $inn)
    {
        $debtor = $this->debModel->getSingleDebtor($inn);
        $debtorTb = $this->tbDebModel->getSingleDebtor($inn);
        $requiredKeys = ['guid', 'fedid', 'name', 'fname', 'adres', 'phone', 'cat', 'inn', 'ogrn', 'snils', 'opf'];
        $difference = parent::findDifference($debtor, $debtorTb, $requiredKeys);
        if ($debtor && $debtorTb) {
            $this->view('debtors/debtor', ['local' => $debtor, 'remote' => $debtorTb, 'diff' => $difference]);
        } else {
            echo '<pre>';
            print_r("Local: $debtor\n");
            print_r("Remote: $debtorTb\n");
            die("Должник с ИНН: $inn не найден в одной/обеих базах");
        }
    }
}