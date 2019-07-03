<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach($arResult["ITEMS"] as $key => $arItem) {
	if(!empty($arItem["PREVIEW_PICTURE"]["ID"])) {
		$file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], BX_RESIZE_IMAGE_EXACT);
		$arResult["ITEMS"][$key]['SIZE_IMG'][$arItem["PREVIEW_PICTURE"]["ID"]] = $file;
	}
	if(is_array($arItem['PROPERTIES']['GALLERY']['VALUE'])) {
		foreach ($arItem['PROPERTIES']['GALLERY']['VALUE'] as $k => $value) {
			$file = CFile::ResizeImageGet($value, BX_RESIZE_IMAGE_EXACT);
			$arResult["ITEMS"][$key]['SIZE_IMG'][$value] = $file;
		}
	}
}


//, array('width'=>250, 'height'=>400)
//, array('width'=>250, 'height'=>400)