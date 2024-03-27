<?php

class Messes extends Controller
{
    protected object $messModel;
    protected object $tbMessModel;

    public function __construct()
    {
        $this->messModel = $this->model('Mess', DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD, 'mess');
        $this->tbMessModel = $this->model('Mess', TB_DB_HOST, DB_NAME, TB_DB_USERNAME, TB_DB_PASSWORD, 'mess');
    }

    public function index()
    {
        $messes = $this->messModel->getAll();
        $this->view('messes/index', $messes);
    }

    public function mess(string $url)
    {
        $mess = $this->messModel->getSingleMess($url);
        $messTb = $this->tbMessModel->getSingleMess($url);
        $requiredKeys = ['url', 'debtor_id', 'date', 'type_id'];
        $difference = parent::findDifference($mess, $messTb, $requiredKeys);
        if ($mess && $messTb) {
            $this->view('messes/mess', ['local' => $mess, 'remote' => $messTb, 'diff' => $difference]);
        } else {
            echo '<pre>';
            print_r("Local:\n");
            print_r($mess);
            print_r("Remote:\n");
            print_r($messTb);
            die("Сообщение (mess): $url не найден в одной/обеих базах");
        }
    }
}