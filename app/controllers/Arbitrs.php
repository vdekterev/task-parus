<?php

class Arbitrs extends Controller
{
    protected object $arbModel;
    protected object $tbArbModel;

    public function __construct()
    {
        $this->arbModel = $this->model('Arbitr', DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD, 'arbitr');
        $this->tbArbModel = $this->model('Arbitr', TB_DB_HOST, DB_NAME, TB_DB_USERNAME, TB_DB_PASSWORD, 'arbitr');
    }

    public function index()
    {
        $arbitrs = $this->arbModel->getAll();
        $this->view('arbitrs/index', $arbitrs);
    }

    public function arbitr(string $inn)
    {
        $arbitr = $this->arbModel->getSingleArbitr($inn);
        $arbitrTb = $this->tbArbModel->getSingleArbitr($inn);
        $requiredKeys = ['guid', 'fedid', 'fio', 'inn', 'nomer', 'reg_date', 'cpo'];
        $difference = parent::findDifference($arbitr, $arbitrTb, $requiredKeys);
        if ($arbitr && $arbitrTb) {
            $this->view('arbitrs/arbitr', ['local' => $arbitr, 'remote' => $arbitrTb, 'diff' => $difference]);
        } else {
            echo '<pre>';
            print_r("Local: $arbitr\n");
            print_r("Remote: $arbitrTb\n");
            die("АУ с ИНН: $inn не найден в одной/обеих базах");
        }
    }
}