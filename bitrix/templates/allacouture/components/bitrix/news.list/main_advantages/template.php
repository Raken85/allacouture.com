<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?
$smallup = $arParams['DISPLAY_SPEED'];
?>
<section class="page__section section section_advantages">
	<div class="section__inner">
		<div class="section__content">
			<div class="slider slider_advantages advantages">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		<a href="#" class="slider__slide advantages__item js-tipsy" title="<?echo $arItem['PREVIEW_TEXT'];?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<span class="advantages__img">
				<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="">
			</span>
			<?echo $arItem["NAME"]?>
		</a>
<?endforeach;?>
			</div>
		</div>
	</div>
</section>
<script>
	window.advantages_options = {
		autoplaySpeed: <?=$smallup?>,
	};
</script>