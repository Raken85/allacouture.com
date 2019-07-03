<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();/** @var array $arParams */

$this->setFrameMode(true);
?>


		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>

		<?
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCT_ELEMENT_DELETE_CONFIRM')));
		$arElement["DETAIL_PAGE_URL"] = $arElement["DISPLAY_PROPERTIES"]["URL"]["VALUE"];
		?>



						<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"  class="menu__link" id="<?=$this->GetEditAreaId($arElement['ID']);?>">

<?=$arElement["NAME"]?>
</a>



		<?endforeach;?>



