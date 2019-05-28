<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
if(!$USER->isAuthorized()){LocalRedirect(SITE_DIR.'auth');} else {
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.profile", 
	"profile_adress", 
	array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CHECK_RIGHTS" => "N",
		"COMPONENT_TEMPLATE" => "profile_adress",
		"SEND_INFO" => "N",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(
		),
		"USER_PROPERTY_NAME" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
<?}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>