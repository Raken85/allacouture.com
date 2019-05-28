<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$index = \Bitrix\Iblock\PropertyIndex\Manager::createIndexer('29');

$index->startIndex();

$index->continueIndex(0); // создание без ограничения по времени

$index->endIndex();