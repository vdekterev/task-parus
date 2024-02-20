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
        $data = ['url' => '',
            'content' => '',
            'initial_price' => '',
            'email' => '',
            'phone' => '',
            'debtor_inn' => '',
            'case_number' => '',
            'start_date' => '',
        ];
        if (!empty($_GET)) {
            $tradeList = new Scraper('https://nistp.ru/bankrot/trade_list.php');
            $tradeNid = $tradeList->regex("/trade_nid=[0-9]+/");
            $tradeInfo = new Scraper("https://nistp.ru/bankrot/trade_view.php?$tradeNid");
            $document = $tradeInfo->getDom();
            $lotNumber = $_GET['lotNumber'];

            $lotTable = $document->find("table#table_lot_$lotNumber tbody")[0]; // !!!
            $organizerTable = $document->find("table.node_view tbody")[0];
            $debtorTable = $document->find("table.node_view[style]")[1];
            $tradeTable = $document->find("table.node_view[style]")[0];
            $tradeType = mb_strtolower($tradeTable->find('tr td:nth-child(2)')[0]->text());

            $data['url'] = $tradeInfo->url;
            $data['content'] = $lotTable->find("tr.alw td:nth-child(2)")[0]->text();
            $data['initial_price'] = $lotTable->find("tr td:nth-child(2)")[4]->text();
            $idx = 4;
            while (!intval($data['initial_price'])) {
                $data['initial_price'] = $lotTable->find("tr td:nth-child(2)")[$idx]->text();
                $idx++;
            }
            $data['email'] = $organizerTable->find("tr td:nth-child(2)")[1]->text();
            $data['phone'] = $organizerTable->find("tr td:nth-child(2)")[2]->text();
            $data['debtor_inn'] = $debtorTable->find("tr td:nth-child(2)")[4]->text();
            $data['case_number'] = $debtorTable->find("tr td:nth-child(2)")[9]->text();

            if (str_contains($tradeType, 'публичное предложение')) {
                $data['start_date'] = date('Y-m-d H:i:s',
                    strtotime($lotTable->find('tr td table tr')[1]->firstChild()->text()));
            } else {
                $data['start_date'] = date('Y-m-d H:i:s',
                    strtotime($tradeTable->find("tr td:nth-child(2)")[3]->text()));
                $this->lotModel->createLot($data);
            }
//            $this->lotModel->createLot($data);
            print_r($data['debtor_inn']);
        }


        $lots = $this->showLots();
        $this->view('lots/index', $lots);
    }

    public function showLots()
    {
        return $this->lotModel->getAllLots();
    }
}