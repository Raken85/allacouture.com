<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "USERNAME" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("USERNAME"),
            "TYPE" => "STRING",
            "DEFAULT" => "instagram"
        ),
        "PHP_CACHE_TIME" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("PHP_CACHE_TIME"),
            "TYPE" => "STRING",
            "DEFAULT" => 3600
        ),
        "IS_JQUERY" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IS_JQUERY"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y"
        ),
    ),
);
?>
