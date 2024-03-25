<?php

class Trades extends Controller
{
    protected object $tradeModel;

    public function __construct()
    {
        $this->tradeModel = $this->model('Trade');
    }

    public function index(): void
    {
        $trades = $this->showTrades();
        $this->view('trades/index', $trades);
    }

    public function showTrades()
    {
        return $this->tradeModel->getAllTrades();
    }
}