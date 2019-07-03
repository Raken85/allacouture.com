<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
if(isset($_REQUEST['AJAX_MODES'])) {
	$GLOBALS['APPLICATION']->RestartBuffer();
	$str = '';
	if(!empty($arResult["ERROR_MESSAGE"]))
	{
		foreach($arResult["ERROR_MESSAGE"] as $k => $v)
			$str .= '<p class="err">'.$v.'</p>';
	}
	echo $str;
	exit;
}