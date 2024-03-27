<?php

class Messages extends Controller
{
    protected object $messageModel;
    protected object $tbMessageModel;

    public function __construct()
    {
        $this->messageModel = $this->model('Message', DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD, 'messages');
        $this->tbMessageModel = $this->model('Message', TB_DB_HOST, DB_NAME, TB_DB_USERNAME, TB_DB_PASSWORD, 'messages');
    }

    public function index()
    {
        $messages = $this->messageModel->getAll();
        $this->view('messages/index', $messages);
    }

    public function message(string $guid, int $lot)
    {
        $message = $this->messageModel->getSingleMessage($guid, $lot);
        $messageTb = $this->tbMessageModel->getSingleMessage($guid, $lot);
        $requiredKeys = ['guid', 'type_id', 'num', 'lot', 'date', 'lot_fedid', 'sended'];
        $difference = parent::findDifference($message, $messageTb, $requiredKeys);
        if ($message && $messageTb) {
            $this->view('messages/message', ['local' => $message, 'remote' => $messageTb, 'diff' => $difference]);
        } else {
            echo '<pre>';
            print_r("Local: $message\n");
            print_r("Remote: $messageTb\n");
            die("Message с guid:$guid и лотом: $lot не найден в одной/обеих базах");
        }
    }
}