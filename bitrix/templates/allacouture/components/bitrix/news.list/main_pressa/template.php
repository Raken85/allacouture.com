<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<section class="page__section section section--press">
	<div class="section__inner">
		<a class="section__header" href="/media/press/">
		<?echo GetMessage("PRESSA");?>
		</a>
			<div class="section__content">
				<div class="slider slider_press">
					<?foreach($arResult["ITEMS"] as $arItem):?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
						<div class="slider__slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<a class="press-card" href="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" data-fancybox="press">
								<img src="<?
											$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 320, "height" => 443), BX_RESIZE_IMAGE_EXACT, false); 
											echo ''.$renderImage["src"].''; 
											?>" alt="<?echo $arItem["NAME"];?>">
								<div class="press-card__text">
									<span class="press-card__name"><?echo $arItem["NAME"];?></span>
									<span class="press-card__descr">
										<?echo $arItem["PREVIEW_TEXT"];?>
									</span>
								</div>
							</a>
						</div>
					<?endforeach;?>
			</div>
		</div>
	</div>
</section>