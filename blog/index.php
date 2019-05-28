<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Блог");
?><?$APPLICATION->IncludeComponent(
	"bitrix:news",
	"blog",
	Array(
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALSO_ITEMS_COUNT" => "5",
		"ALSO_ITEMS_POSITION" => "side",
		"BLOG_TITLE" => "Комментарии",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "100000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMMENTS_COUNT" => "10",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_ACTIVE_DATE_FORMAT" => "j F Y G:i",
		"DETAIL_BLOG_EMAIL_NOTIFY" => "Y",
		"DETAIL_BLOG_URL" => "catalog_comments",
		"DETAIL_BLOG_USE" => "Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FB_APP_ID" => "",
		"DETAIL_FB_USE" => "Y",
		"DETAIL_FIELD_CODE" => array("TAGS","PREVIEW_TEXT","DETAIL_TEXT","DETAIL_PICTURE","DATE_ACTIVE_FROM",""),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array("LINK_GOODS","FORM_QUESTION","FORM_ORDER","LINK_SERVICES","PHOTOS","DOCUMENTS",""),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_STRICT_SECTION_CHECK" => "Y",
		"DETAIL_USE_COMMENTS" => "Y",
		"DETAIL_VK_API_ID" => "",
		"DETAIL_VK_USE" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_NAME" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_TYPE_VIEW" => "element_1",
		"FB_TITLE" => "Facebook",
		"FILE_404" => "",
		"FILTER_FIELD_CODE" => array("",""),
		"FILTER_NAME" => "arRegionLink",
		"FILTER_PROPERTY_CODE" => array("",""),
		"FORM_ID_ORDER_SERVISE" => "",
		"GALLERY_TYPE" => "small",
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "30",
		"IBLOCK_TYPE" => "aspro_next_content",
		"IMAGE_POSITION" => "left",
		"IMAGE_WIDE" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LINE_ELEMENT_COUNT" => "2",
		"LINE_ELEMENT_COUNT_LIST" => "3",
		"LINKED_ELEMENST_PAGE_COUNT" => "20",
		"LIST_ACTIVE_DATE_FORMAT" => "j F Y G:i",
		"LIST_FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE","DATE_ACTIVE_FROM",""),
		"LIST_PROPERTY_CODE" => array("POSITION_BLOCK",""),
		"LIST_VIEW" => "slider",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "6",
		"NUM_DAYS" => "30",
		"NUM_NEWS" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "main",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "250",
		"PRICE_CODE" => array(),
		"SECTION_ELEMENTS_TYPE_VIEW" => "FROM_MODULE",
		"SEF_FOLDER" => "/blog/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => Array("detail"=>"#SECTION_CODE#/#ELEMENT_CODE#/","news"=>"","rss"=>"rss/","rss_section"=>"#SECTION_ID#/rss/","section"=>"#SECTION_CODE#/"),
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "Y",
		"SHOW_DETAIL_LINK" => "Y",
		"SHOW_DISCOUNT_PERCENT_NUMBER" => "N",
		"SHOW_NEXT_ELEMENT" => "N",
		"SHOW_SECTION_DESCRIPTION" => "Y",
		"SHOW_SECTION_PREVIEW_DESCRIPTION" => "Y",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STORES" => array("",""),
		"STRICT_SECTION_CHECK" => "Y",
		"S_ASK_QUESTION" => "",
		"S_ORDER_SERVISE" => "",
		"T_ALSO_ITEMS" => "",
		"T_DOCS" => "",
		"T_GALLERY" => "",
		"T_GOODS" => "",
		"T_NEXT_LINK" => "",
		"T_PREV_LINK" => "",
		"T_SERVICES" => "",
		"T_STUDY" => "",
		"T_VIDEO" => "",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "Y",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "Y",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "Y",
		"VK_TITLE" => "Вконтакте",
		"YANDEX" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>