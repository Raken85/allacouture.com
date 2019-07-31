<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?> <?global $arTheme, $isShowCatalogSections;?> <?if($isShowCatalogSections):?> <?$APPLICATION->IncludeComponent(
	"aspro:catalog.section.list.next",
	"front_sections_theme_custom",
	Array(
		"ADD_SECTIONS_CHAIN" => "N",
		"ALL_URL" => "catalog/",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "front_sections_theme",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"COUNT_ELEMENTS" => "N",
		"DISPLAY_PANEL" => "N",
		"FILTER_NAME" => "arrPopularSections",
		"HIDE_SECTION_NAME" => "N",
		"IBLOCK_ID" => "29",
		"IBLOCK_TYPE" => "aspro_next_catalog",
		"SECTIONS_LIST_PREVIEW_DESCRIPTION" => "N",
		"SECTIONS_LIST_PREVIEW_PROPERTY" => "N",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(0=>"",1=>"",),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SHOW_PARENT_NAME" => "N",
		"SHOW_SECTIONS_LIST_PREVIEW" => "N",
		"SHOW_SECTION_LIST_PICTURES" => "N",
		"TEMPLATE" => $arTheme["FRONT_PAGE_SECTIONS"]["VALUE"],
		"TITLE_BLOCK" => "Популярные категории",
		"TITLE_BLOCK_ALL" => "Весь каталог",
		"TOP_DEPTH" => "",
		"VIEW_MODE" => ""
	)
);?> <?endif;?>
<p align="center" class="instagram_remove_top_margin">
 <span class="span1_mainpage"><br>
 </span>
</p>
<p align="center">
 <span class="hidden-link-class" data-link="https://www.instagram.com/allacouture/" data-class="instagram_mainpage">Instagram <i>@</i><i>AllaCouture</i></span>
</p>
 <b><span class="span2_mainpage">
<div class="instagram_remove_bottom_margin">
	 <?$APPLICATION->IncludeComponent(
	"aspro:instargam.next", 
	"main", 
	array(
		"TITLE" => "Последние новости",
		"TOKEN" => "8561996155.614b2e0.f06f6c1ed4974a38b58b7b49e3cd6f87",
		"COMPONENT_TEMPLATE" => "main",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?><br>
</div>
<?/*<h1 style="display: inline !important;"></h1>*/?>
 </span></b>