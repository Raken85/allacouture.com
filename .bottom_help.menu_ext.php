<?
$aMenuLinksExt = array();

if($arMenuParametrs = CNext::GetDirMenuParametrs(__DIR__))
{
	if($arMenuParametrs['MENU_SHOW_SECTIONS'] == 'Y')
	{
		$catalog_id = \Bitrix\Main\Config\Option::get('aspro.next', 'CATALOG_IBLOCK_ID', CNextCache::$arIBlocks[SITE_ID]['aspro_next_catalog']['aspro_next_catalog'][0]);
		$arSections = CNextCache::CIBlockSection_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => CNextCache::GetIBlockCacheTag($catalog_id), 'MULTI' => 'Y')), array('IBLOCK_ID' => $catalog_id, 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', '<DEPTH_LEVEL' => \Bitrix\Main\Config\Option::get("aspro.next", "MAX_DEPTH_MENU", 2)));
		$arSectionsByParentSectionID = CNextCache::GroupArrayBy($arSections, array('MULTI' => 'Y', 'GROUP' => array('IBLOCK_SECTION_ID')));
	}
	if($arSections)
		CNext::getSectionChilds(false, $arSections, $arSectionsByParentSectionID, $arItemsBySectionID, $aMenuLinksExt);
}

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>