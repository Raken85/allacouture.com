<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Iblock\InheritedProperty;
if(is_array($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])) {
	foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $k => $value) {
		$file = CFile::ResizeImageGet($value, array('width'=>250, 'height'=>400), BX_RESIZE_IMAGE_EXACT);
		$arResult['SIZE_IMG'][$value] = $file;
	}
}
$query = CIBlockElement::GetList(array('ID' => 'DESC'), array(
   'IBLOCK_ID' => $arResult['IBLOCK_ID'],
   'ACTIVE' => 'Y'
	),
   false, array('nPageSize' => 1, 'nElementID' => $arResult['ID']),
   array('ID', 'DETAIL_PAGE_URL')
);
while($elem = $query->GetNextElement()){
    $arFields = $elem->GetFields();
    if($arFields['ID'] > $arResult['ID']) $arResult['NEXT_PAGE'] = $arFields['DETAIL_PAGE_URL'];
    if($arFields['ID'] < $arResult['ID']) $arResult['PREV_PAGE'] = $arFields['DETAIL_PAGE_URL'];
}
if(!empty($arResult['TAGS'])) $arResult['TAGS'] = explode(',', $arResult['TAGS']);