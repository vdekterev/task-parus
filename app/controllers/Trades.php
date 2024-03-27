<?php

class Trades extends Controller
{
    protected object $tradeModel;
    protected object $tbTradeModel;

    public function __construct()
    {
        $this->tradeModel = $this->model('Trade', DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD, 'torgi');
        $this->tbTradeModel = $this->model('Trade', TB_DB_HOST, DB_NAME, TB_DB_USERNAME, TB_DB_PASSWORD, 'torgi');
    }

    public function index(): void
    {
        $trades = $this->tradeModel->getAll();
        $this->view('trades/index', $trades);
    }

    public function trade(string $guid, int $lot)
    {
        $trade = $this->tradeModel->getSingleTrade($guid, $lot);
        $tradeTb = $this->tbTradeModel->getSingleTrade($guid, $lot);
        $requiredKeys = ['fedid', 'guid', 'place', 'type', 'section', 'num',
            'lot', 'price', 'pricestep', 'zadatok', 'tstart', 'tend',
            'zstart', 'zend', 'sud', 'nomer_dela', 'min_price', 'cur_price',
            'price_percent', 'adres', 'status', 'debtor', 'debtorid', 'arbitr',
            'arbitrid', 'org', 'orgid','closed', 'close_date', 'public'];
        $difference = parent::findDifference($trade, $tradeTb, $requiredKeys);
        if ($trade && $tradeTb) {
            $this->view('trades/trade', ['local' => $trade, 'remote' => $tradeTb, 'diff' => $difference]);
        } else {
            die("Запись: $guid с лотом $lot не найдена в одной из баз");
        }
    }

    public function updateTrades()
    {
        $recentTrades = $this->tradeModel->getRecentTrades();
        if ($recentTrades) {
            print_r(json_encode($recentTrades));
            return;
        }

    }
}