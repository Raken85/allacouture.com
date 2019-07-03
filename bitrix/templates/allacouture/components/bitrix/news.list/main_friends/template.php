<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<section class="page__section section section--friends">
	<div class="section__inner section__inner_border_top">
		<a class="section__header" href="/friends/">
		<?echo GetMessage("FRIENDS");?>
		</a>
			<div class="section__content">
				<div class="slider slider_friends js-scroll" data-vis="visible-xs" data-axis="x" >
					<?foreach($arResult["ITEMS"] as $arItem):?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
							<div class="slider__slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
								<a class="friend-card friend-card_slider" href="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"  data-fancybox="press">
									<img src="<?
			$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 321, "height" => 557), BX_RESIZE_IMAGE_EXACT, false); 
			echo ''.$renderImage["src"].''; 
			?>" alt="<?echo $arItem["NAME"]?>">
									<span class="friend-card__name"><span><?echo $arItem["NAME"]?></span></span>
								</a>
							</div>
					<?endforeach;?>
			</div>
		</div>
	</div>
</section>

