<?php

use libraries\Scraper;

?>
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</head>
<body>

<div class="container text-center mt-4">
    <form action="#" class="form">
        <div class="row justify-content-md-center">
            <div class="col-3">
                <div class="mb-3">
                    <label for="tradeNumber" class="form-label">Номер торгов</label>
                    <input type="text" class="form-control" name="tradeNumber" id="tradeNumber"
                           placeholder="пример: 31710-ОТПП" value="<?= $_GET['tradeNumber'] ?? '' ?>"" required>
                </div>
                <div id="alert" style="display: none">
                    <div class="alert alert-primary alert-dismissible" role="alert">
                        <div>Неверно заполнено поле</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="lotNumber" class="form-label">Номер лота</label>
                    <input type="number" class="form-control" id="lotNumber" value="<?= $_GET['lotNumber'] ?? '' ?>"
                           name="lotNumber" max="9999"
                           placeholder="1-9999" required>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" id="submitBtn">
                </div>
            </div>
        </div>

    </form>
</div>
<script src="public/js/script.js"></script>
</body>
</html>

<?php
require_once 'Scraper.php';

if (empty($_GET)) {
    return;
} else {
    $tradeList = new Scraper('https://nistp.ru/bankrot/trade_list.php');
    $tradeNid = $tradeList->regex("/trade_nid=[0-9]+/");
    $tradeInfo = new Scraper("https://nistp.ru/bankrot/trade_view.php?$tradeNid");
    $document = $tradeInfo->getDom();

    $lotTable = $document->find("table#table_lot_1 tbody")[0]; // СМЕНИТЬ ID
    $organizerTable = $document->find("table.node_view tbody")[0];
    $debtorTable = $document->find("table.node_view[style]")[1];
    $tradeTable = $document->find("table.node_view[style]")[0];

    $url = $tradeInfo->url;
    $content = $lotTable->find("tr.alw td:nth-child(2)")[0]->text();
    $initialPrice = $lotTable->find("tr td:nth-child(2)")[6]->text();
    $email = $organizerTable->find("tr td:nth-child(2)")[1]->text();
    $phone = $organizerTable->find("tr td:nth-child(2)")[2]->text();
    $debtorInn = $debtorTable->find("tr td:nth-child(2)")[3]->text();
    $caseNumber = $debtorTable->find("tr td:nth-child(2)")[8]->text();
    $startDate = $tradeTable->find("tr td:nth-child(2)")[3]->text();

    echo '<pre>';
    echo $url = $tradeInfo->url;
    echo '<br>';
    echo $content = $lotTable->find("tr.alw td:nth-child(2)")[0]->text();
    echo '<br>';
    echo $initialPrice = $lotTable->find("tr td:nth-child(2)")[6]->text();
    echo '<br>';
    echo $email = $organizerTable->find("tr td:nth-child(2)")[1]->text();
    echo '<br>';
    echo $phone = $organizerTable->find("tr td:nth-child(2)")[2]->text();
    echo '<br>';
    echo $debtorInn = $debtorTable->find("tr td:nth-child(2)")[3]->text();
    echo '<br>';
    echo $caseNumber = $debtorTable->find("tr td:nth-child(2)")[8]->text();
    echo '<br>';
    echo $startDate = $tradeTable->find("tr td:nth-child(2)")[3]->text();
    echo '<br>';
}