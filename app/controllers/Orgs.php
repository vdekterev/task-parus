<?php

class Orgs extends Controller
{
    protected object $orgModel;
    protected object $tbOrgModel;

    public function __construct()
    {
        $this->orgModel = $this->model('Org', DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD, 'org');
        $this->tbOrgModel = $this->model('Org', TB_DB_HOST, DB_NAME, TB_DB_USERNAME, TB_DB_PASSWORD, 'org');
    }

    public function index(): void
    {
        $debtors = $this->orgModel->getAll();
        $this->view('orgs/index', $debtors);
    }

    public function org(int $inn)
    {
        $org = $this->orgModel->getSingleOrg($inn);
        $orgTb = $this->tbOrgModel->getSingleOrg($inn);
        $requiredKeys = ['guid', 'fedid', 'name', 'fname', 'adres', 'inn', 'kpp', 'ogrn', 'opf', 'phone', 'mail'];
        $difference = parent::findDifference($org, $orgTb, $requiredKeys);
        if ($org && $orgTb) {
            $this->view('orgs/org', ['local' => $org, 'remote' => $orgTb, 'diff' => $difference]);
        } else {
            echo '<pre>';
            print_r("Local: $org\n");
            print_r("Remote: $orgTb\n");
            die("Организатор с ИНН: $inn не найден в одной из баз");
        }
    }
}