<?global $arTheme;?>
<?$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "top",
    array(
        "ALLOW_MULTI_SELECT" => "Y",
        "CHILD_MENU_TYPE" => "left",
        "COMPONENT_TEMPLATE" => "top",
        "COUNT_ITEM" => "6",
        "DELAY" => "N",
        "MAX_LEVEL" => "4",
        "MENU_CACHE_GET_VARS" => array(
        ),
        "MENU_CACHE_TIME" => "3600000",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_USE_GROUPS" => "N",
        "CACHE_SELECTED_ITEMS" => "N",
        "ROOT_MENU_TYPE" => "top_content_multilevel",
        "USE_EXT" => "Y",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "DYNAMIC_WITH_STUB_LOADING"
    ),
    false
);?>