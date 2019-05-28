<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;

if (isset($templateData['TEMPLATE_LIBRARY']) && !empty($templateData['TEMPLATE_LIBRARY'])){
	$loadCurrency = false;
	if (!empty($templateData['CURRENCIES']))
		$loadCurrency = Loader::includeModule('currency');
	CJSCore::Init($templateData['TEMPLATE_LIBRARY']);
	if ($loadCurrency){?>
	<script type="text/javascript">
		BX.Currency.setCurrencies(<? echo $templateData['CURRENCIES']; ?>);
	</script>
	

	
	<?}
}


global $APPLICATION;

use Bitrix\Main\Application;

$arGetParams = Application::getInstance()->getContext()->getRequest()->getQueryList()->toArray();

if ($arGetParams["PAGEN_" . $arResult["NAV_NUM"]] > 0 && $arResult["NAV_NUMBER"] != $arGetParams["PAGEN_" . $arResult["NAV_NUM"]])
{
	localredirect("https://allacouture.com".strtok($_SERVER['REQUEST_URI'], '?'), false, '301 Moved permanently');
}


if($USER->IsAdmin()){
	//printf("<pre>%s</pre>", print_r($arResult, true));
	//printf("<pre>%s</pre>", print_r($_SERVER, true));
}


// if($arResult['NAV_RESULT']->NavPageCount < $arResult['NAV_RESULT']->PAGEN) {
// 	localredirect($_SERVER['HTTP_REFERER'], false, '301 Moved permanently');
// }

?>