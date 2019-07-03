<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();
?>



<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
	ShowMessage($arResult['ERROR_MESSAGE']);
?>

<?if($arResult["FORM_TYPE"] == "login"):?>


<?/*
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "icons", 
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"SUFFIX"=>"form",
	), 
	$component, 
	array("HIDE_ICONS"=>"Y")
);*/
?>
<? 
						 $APPLICATION ->IncludeComponent( "bitrix:socserv.auth.form" ,  "flat" ,
							array (
							   "AUTH_SERVICES"  =>  $arResult [ "AUTH_SERVICES" ],
							   "CURRENT_SERVICE"  =>  $arResult [ "CURRENT_SERVICE" ],
							   "AUTH_URL"  =>  $arResult [ "AUTH_URL" ],
							   "POST"  =>  $arResult [ "POST" ],
							   "SHOW_TITLES"  =>  $arResult [ "FOR_INTRANET" ]? 'N' : 'Y' ,
							   "FOR_SPLIT"  =>  $arResult [ "FOR_INTRANET" ]? 'Y' : 'N' ,
							   "AUTH_LINE"  =>  $arResult [ "FOR_INTRANET" ]? 'N' : 'Y' ,
						   ),
							$component ,
							array ( "HIDE_ICONS" => "Y" )
						);
						?> 

<?if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "", 
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"AUTH_URL"=>$arResult["AUTH_URL"],
		"POST"=>$arResult["POST"],
		"POPUP"=>"Y",
		"SUFFIX"=>"form",
	), 
	$component, 
	array("HIDE_ICONS"=>"Y")
);
?>
<?endif?>

<?
elseif($arResult["FORM_TYPE"] == "otp"):
?>



<?
else:
?>


<?endif?>

