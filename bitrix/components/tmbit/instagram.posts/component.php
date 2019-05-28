<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/*if ($arParams["IS_JQUERY"] == "Y")
    CJSCore::Init(array("jquery"));*/

if ($_POST["endcursor"] && $_POST['id']) {
    $APPLICATION->RestartBuffer();

    $id = $_POST['id'];
    $endcursor = $_POST['endcursor'];
    $arResult["INSTAGRAM"] = $this->getPosts($arParams["USERNAME"], $id, $endcursor);

    ob_start();
    $this->IncludeComponentTemplate();
    $posts = ob_get_contents();
    ob_end_clean();

    echo \Bitrix\Main\Web\Json::encode(array(
        'posts' => $posts,
        'endcursor' => $arResult["INSTAGRAM"]["end_cursor"]
    ));
    die();
}

$obCache = new CPHPCache();
$cacheLifetime = $arParams["PHP_CACHE_TIME"];
$cacheID = 'instagramPosts';
$cachePath = '/'.$cacheID;
if ($obCache->InitCache($cacheLifetime, $cacheID, $cachePath)) {
    $vars = $obCache->GetVars();
    $arResult["INSTAGRAM"] = $vars['arInstagramPosts'];
} elseif ($obCache->StartDataCache()) {
    $arResult["INSTAGRAM"] = $this->getPosts($arParams["USERNAME"]);
    $obCache->EndDataCache(array('arInstagramPosts' => $arResult["INSTAGRAM"]));
}

$this->IncludeComponentTemplate();
?>
