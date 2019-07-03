<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?
$smallup = $arParams['DISPLAY_SPEED'];
?>

<div class="logo__slogan slider slider_logo">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="slider__slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?echo $arItem["PREVIEW_TEXT"];?>
	</div>
<?endforeach;?>
</div>
<script>
	window.slogan_options = {
		autoplaySpeed: <?=$smallup?>,
	};
</script>