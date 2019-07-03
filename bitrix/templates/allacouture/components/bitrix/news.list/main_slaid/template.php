<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<section class="page__section section section_nomargin">
	<div class="slider slider_main">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		
			<div class="slider__slide" style="background-image: url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>')" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		
				<div class="slider__inner">
					<a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" class="slider__content slider__content_left">
					
						<!-- <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" class="slider__header">
							<?echo $arItem["NAME"]?>
						</a> -->
						<span class="slider__header">
						<?echo $arItem["NAME"]?>
						</span>
						<div class="slider__text">
							<p>
								<?echo $arItem["PREVIEW_TEXT"];?>
							</p>
						</div>
					</a>
				</div>
			</div>
		
<?endforeach;?>
	</div>
</section>