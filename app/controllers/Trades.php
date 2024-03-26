<?php

class Trades extends Controller
{
    protected object $tradeModel;
    protected object $tbTradeModel;

    public function __construct()
    {
        $this->tradeModel = $this->model('Trade', DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $this->tbTradeModel = $this->model('Trade', TB_DB_HOST, DB_NAME, TB_DB_USERNAME, TB_DB_PASSWORD);
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

        if ($trade && $tradeTb) {
            $this->view('trades/trade', ['local' => $trade, 'remote' => $tradeTb]);
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