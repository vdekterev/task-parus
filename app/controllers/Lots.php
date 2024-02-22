<?php

class Lots extends Controller
{
    protected object $lotModel;

    public function __construct()
    {
        $this->lotModel = $this->model('Lot');
    }

    public function index(): void
    {
        if (!empty($_GET)) {
            $tradeList = new Scraper('https://nistp.ru/bankrot/trade_list.php');
            $tradeNid = $tradeList->regex("/trade_nid=[0-9]+/");
            if ($tradeNid) {
                $tradeInfo = new Scraper("https://nistp.ru/bankrot/trade_view.php?$tradeNid");
                $document = $tradeInfo->getDom();
                $lotNumber = $_GET['lotNumber'];
                $data['lot_number'] = $lotNumber;

                $lotTable = $document->find("table#table_lot_$lotNumber tbody tr td:nth-child(1)");
                $organizerTable = $document->find("table.node_view")[0]->find('tbody tr td:nth-child(1)');
                $debtorTable = $document->find("table.node_view[style]")[1]->find('tr td:nth-child(1)');
                $tradeTable = $document->find("table.node_view[style]")[0]->find('tr td:nth-child(1)');

                $data['url'] = $tradeInfo->url;
                foreach ($lotTable as $row) {
                    switch (true) {
                        case preg_match("/cведения об имуществе/ui", $row->text()):
                            $data['content'] = $row->nextSibling()->text();
                            break;
                        case preg_match("/начальная цена/ui", $row->text()):
                            $data['initial_price'] = $row->nextSibling()->text();
                            break;
                    }
                }
                foreach ($organizerTable as $row) {
                    switch (true) {
                        case $row->text() == "E-mail":
                            $data['email'] = $row->nextSiblings(null, 'DOMElement')[0]->text();
                            break;
                        case $row->text() == "Телефон":
                            $data['phone'] = $row->nextSiblings(null, 'DOMElement')[0]->text();
                            break;
                    }
                }
                foreach ($debtorTable as $row) {
                    switch (true) {
                        case $row->text() == "ИНН":
                            $data['debtor_inn'] = $row->nextSibling()->text();
                            break;
                        case $row->text() == "Номер дела о банкротстве":
                            $data['case_number'] = $row->nextSibling()->text();
                    }
                }
                foreach ($tradeTable as $row) {
                    switch (true) {
                        case $row->text() == "Дата проведения":
                        case $row->text() == "Дата начала представления заявок на участие":
                            $data['start_date'] = date('Y-m-d H:i:s',
                                strtotime($row->nextSibling()->text()));
                            break;
                    }
                }
                if (!$this->lotModel->lotExists($data['case_number'], $data['content'])) {
                    $this->lotModel->createLot($data);
                } else {
                    echo '<script>alert("Лот обновлен")</script>';
                    $this->lotModel->updateLot($data, $data['content'], $data['case_number']);
                }
            } else {
                echo '<script>alert("Предмет торгов не найден")</script>';
            }
        }
        $lots = $this->showLots();
        $this->view('lots/index', $lots);
    }

    public function showLots()
    {
        return $this->lotModel->getAllLots();
    }
}