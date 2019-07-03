<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<section class="page__section section">
	<div class="section__inner section__inner_border_bottom">
		<a class="section__header" href="https://www.youtube.com/channel/UCYV79iCK0JUNM7-B3cAioNA">
		#allacouture <br>
		youtube канал
		</a>
			<div class="section__content">
				<div class="slider slider_video">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="slider__slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="slider__video">
			<?if($arItem['PROPERTIES']['LINK']['VALUE']){
			if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $arItem['PROPERTIES']['LINK']['VALUE'], $match)) {
				$video_id = $match[1];
			}
			?>
				<iframe src="https://www.youtube.com/embed/<?=$video_id?>?rel=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
			<?}?>
		</div>
	</div>
<?endforeach;?>
			</div>
		</div>
	</div>
</section>