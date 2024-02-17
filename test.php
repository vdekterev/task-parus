<?php
require_once 'vendor/autoload.php';
require_once 'index.php';
use DiDom\Document;

$dom = parser('https://nistp.ru/bankrot/trade_view.php?trade_nid=354636');
$document = new Document();
$document->loadHtml($dom);
$res = $document->find('table#table_lot_1 tbody tr.alw td')[3]->text();
echo '<pre>';
print_r($res);
