<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
	"GROUPS" => array(
		"GALLERY" => array(
			"NAME" => GetMessage("GROUP_GALLERY"),
			"SORT" => 110
		),
        "ADDITIONAL" => array(
			"NAME" => GetMessage("GROUP_ADDITIONAL"),
			"SORT" => 120
		),
	),
	"PARAMETERS" => array(
		"NOTE" => array(
			"PARENT" => "BASE",
			"TYPE" => "CUSTOM",
			"JS_FILE" => "/bitrix/js/main/comp_props.js",
			"JS_EVENT" => "BxShowComponentNotes",
			"JS_DATA" => GetMessage("NOTE"),
		),
		"USERNAME" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("USERNAME"),
			"TYPE" => "TEXT",
			"DEFAULT" => "1cbitrix",
		),
		"MEDIA_COUNT" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("MEDIA_COUNT"),
			"TYPE" => "TEXT",
			"DEFAULT" => "9",
		), 			
        "SHOW_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" =>  GetMessage("SHOW_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => array("WEBSITE" => GetMessage("SHOW_TYPE_WEBSITE"), "INSTAGRAM" => GetMessage("SHOW_TYPE_INSTAGRAM")),
			"DEFAULT" => "WEBSITE",
		),
        /********************************************************************************/
        "SHOW_DESCRIPTION" => array(
			"PARENT" => "GALLERY",
			"NAME" =>  GetMessage("SHOW_DESCRIPTION"),
			"TYPE" => "LIST",
			"VALUES" => array("Y" => GetMessage("YES"), "N" => GetMessage("NO")),
			"DEFAULT" => "Y",
		),
        "ADD_JQUERY" => array(
			"PARENT" => "GALLERY",
			"NAME" =>  GetMessage("ADD_JQUERY"),
			"TYPE" => "LIST",
			"VALUES" => array("Y" => GetMessage("YES"), "N" => GetMessage("NO")),
			"DEFAULT" => "Y",
		),
        "PLUGIN_TYPE" => array(
			"PARENT" => "GALLERY",
			"NAME" =>  GetMessage("PLUGIN_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => array(
                "FANCYBOX3" => GetMessage("PLUGIN_TYPE_FANCYBOX3"),
                "MAGNIFICPOPUP" => GetMessage("PLUGIN_TYPE_MAGNIFICPOPUP"),
            ),
			"DEFAULT" => "FANCYBOX3",
		),
        "ADD_PLUGIN" => array(
			"PARENT" => "GALLERY",
			"NAME" =>  GetMessage("ADD_PLUGIN"),
			"TYPE" => "LIST",
			"VALUES" => array("Y" => GetMessage("YES"), "N" => GetMessage("NO")),
			"DEFAULT" => "Y",
		),
        /********************************************************************************/
		"NOINDEX_WIDGET" => array(
			"PARENT" => "ADDITIONAL",
			"NAME" =>  GetMessage("NOINDEX_WIDGET"),
			"TYPE" => "LIST",
			"VALUES" => array("Y" => GetMessage("YES"), "N" => GetMessage("NO")),
			"DEFAULT" => "Y",
		),
		"NOINDEX_LINKS" => array(
			"PARENT" => "ADDITIONAL",
			"NAME" =>  GetMessage("NOINDEX_LINKS"),
			"TYPE" => "LIST",
			"VALUES" => array("Y" => GetMessage("YES"), "N" => GetMessage("NO")),
			"DEFAULT" => "Y",
		),        
		"CACHE_SETTINGS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"TYPE" => "CUSTOM",
			"JS_FILE" => "/bitrix/js/main/comp_props.js",
			"JS_EVENT" => "BxShowComponentNotes",
			"JS_DATA" => GetMessage("NOTE_CACHE_SETTINGS"),
		),
		"CACHE_TIME" => array(
			"DEFAULT" => 3600*24,
		),
	),
);
?>