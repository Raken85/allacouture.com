<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach($arResult["ITEMS"] as $key => $arItem) {
	if(!empty($arItem["PREVIEW_PICTURE"]["ID"])) {
		$file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>270, 'height'=>370), BX_RESIZE_IMAGE_EXACT);
		$arResult["ITEMS"][$key]['SIZE_IMG'] = $file;
	}
}