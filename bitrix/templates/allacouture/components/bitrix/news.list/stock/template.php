<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<section class="page__section section section_promo ">
	<div class="section__inner">
		<a class="section__header" href="/stock/">
			<?echo GetMessage("STOCK");?>
		</a>
			<div class="section__content">
				<div class="slider slider_promo">
<?foreach($arResult["ITEMS"] as $arItem): ?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
<div class="slider__slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	<div class="promo" style="position: relative;">
		<div class="promo__img">
			<?$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 294, "height" => 380), BX_RESIZE_IMAGE_EXACT, false); ?>
			<?if(!empty($renderImage['src'])):?>
				<img src="<?=$renderImage["src"];?>" alt="<?echo $arItem["NAME"]?>">
			<?else:?>
				<div style="min-height: 325px;"></div>
			<?endif;?>
			<?
			$hours = '';
			$minutes = '';
			$second = '';

			if(!empty($arItem['PROPERTIES']['DATE']['VALUE'])) {
				$timestamp = strtotime($arItem['PROPERTIES']['DATE']['VALUE']);
				if($timestamp > time()) {
					$timestamp -= time();
					$hours = date('H', $timestamp);
					$minutes = date('m', $timestamp);
					$seconds = date('s', $timestamp);
			?>
				<div class="promo__timeleft">
					<span><?echo GetMessage("END");?>:</span>
					<div class="promo__timer js-action-timer" data-timer-id="<?=$arItem['ID']?>" data-timer="<?=$timestamp?>">
                       <span class="timer-hours"><?echo $hours;?></span>&nbsp;ч.&nbsp;
                       <span class="timer-mins"><?echo $minutes;?></span>&nbsp;мин.&nbsp;
                       <span class="timer-secs"><?echo $seconds;?>&nbsp;</span>&nbsp;сек.
                    </div>
					<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo GetMessage("CONDIT");?></a>
				</div>
					<?}?>
			<?}?>
		</div>
		<div class="promo__content">
			<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="promo__header">
				<?echo $arItem["NAME"]?>
			</a>
			<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="promo__text">
					<p>
						<?echo $arItem["PREVIEW_TEXT"];?>
					</p>
				</a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
			<?endif;?>
			<div class="promo__more">
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo GetMessage("DETAIL");?></a>
			</div>
		</div>
		<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></a>
	</div>
</div>


<?endforeach;?>
			</div>
		</div>
	</div>
</section>