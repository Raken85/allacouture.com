<?global $arTheme;?>
<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_fixed_field", 
	array(
		"COMPONENT_TEMPLATE" => "top_fixed_field",
		"MENU_CACHE_TIME" => "3600000",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"DELAY" => "N",
		"MAX_LEVEL" => "3",
		"ALLOW_MULTI_SELECT" => "Y",
		"ROOT_MENU_TYPE" => "top_content_multilevel",
		"CHILD_MENU_TYPE" => "submenu_fixed",
		"CACHE_SELECTED_ITEMS" => "N",
		"USE_EXT" => "Y",
		"COMPOSITE_FRAME_MODE" => "N",
		"COMPOSITE_FRAME_TYPE" => "STATIC"
	),
	false
);?>