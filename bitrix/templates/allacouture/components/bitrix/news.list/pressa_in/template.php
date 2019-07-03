<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//$this->setFrameMode(true);
$bxajaxid = CAjax::GetComponentID($component->__name, $component->__template->__name);
if($_GET["bxajaxid"]) $APPLICATION->RestartBuffer();
?>

<?if(!empty($arResult['ITEMS'])):?>
    <?if(!$_GET["bxajaxid"]):?>  

<div class="page__press">
	
	<section class="page__section section section_small page-news">
		<div class="section__inner">
			<div class="section__content">

				<div class="section__before-text">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
						  "AREA_FILE_SHOW" => "file",
						  "AREA_FILE_SUFFIX" => "inc",
						  "EDIT_TEMPLATE" => "",
						  "PATH" => "/include/pressa.php"
						)
					);?>
				</div>





		<?if($arParams["DISPLAY_TOP_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?><br />
		<?endif;?>
		<div class="press-cards friends__catalog-list"  id="comp_<?=$bxajaxid?>">
    <?endif;?>
	
	<?
	$i = 1;
	foreach($arResult["ITEMS"] as $arItem):
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		<div class="friend-card" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="friend-card__img">
				<div class="slider slider_friend">  					  
					<?if(is_array($arItem["DETAIL_PICTURE"])):?>
						<div class="slider__slide 1">
							<?php $file = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array('width'=>277, 'height'=>360), BX_RESIZE_IMAGE_EXACT, true); ?>
							<img src="<?= $file['src']?>" data-src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" rel="gallery-group-<?=$i?>" data-lightgroup="gallery-group-<?=$i?>">
							<?php $file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>277, 'height'=>360), BX_RESIZE_IMAGE_EXACT, true); ?>
							<img src="<?= $file['src']?>" data-src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" rel="gallery-group-<?=$i?>" data-lightgroup="gallery-group-<?=$i?>">
						</div>
						<?elseif(is_array($arItem["PREVIEW_PICTURE"])):?>
						<div class="slider__slide 2">
							<?php $file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>277, 'height'=>360), BX_RESIZE_IMAGE_EXACT, true); ?>
							
							<img src="<?= $file['src']?>" data-src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" rel="gallery-group-<?=$i?>" data-lightgroup="gallery-group-<?=$i?>">
						</div>
						<?endif?>
						
						<?foreach ($arItem["PROPERTIES"]["GALLERY"]["VALUE"] as $ex => $files):?> 
						<? $arFile = CFile::GetFileArray($files); 
							if( $arFile) :?>
								<div class="slider__slide">
									<?php $file = CFile::ResizeImageGet($arFile, array('width'=>277, 'height'=>360), BX_RESIZE_IMAGE_EXACT, true); ?>
									<img src="<?= $file['src']?>" data-src="<?=$arFile["SRC"]?>" rel="gallery-group-<?=$i?>" data-lightgroup="gallery-group-<?=$i?>">
								</div>
							<? endif; ?> 
						<?endforeach?>
				</div>
			</div>
			<div class="friend-card__name">
				<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
						<span><?echo $arItem["NAME"]?></span>
				<?endif;?>
				<?if($arItem["PROPERTIES"]["GALLERY"]["VALUE"]>""):?>
					<a href="#" class="js-open-friends-gallery" data-fancy-lightgroup="gallery-group-<?=$i?>">Посмотреть все фото</a>
				<?endif;?>
			</div>
			<div class="friend-card__hover">
				<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
					<p><?echo $arItem["PREVIEW_TEXT"];?></p>
				<?endif;?>
				<a href="#" class="friend-card__goto button button_big js-open-friends-gallery" data-fancy-lightgroup="gallery-group-<?=$i?>">
					Читать статью
				</a>
			</div>
		</div>
	<?$i++;
	endforeach;?>
	
	<?if($arResult["NAV_RESULT"]->nEndPage > 1 && $arResult["NAV_RESULT"]->NavPageNomer<$arResult["NAV_RESULT"]->nEndPage):?>
		<div id="btn_<?=$bxajaxid?>" class="btn-wrap text-center">
			<button data-ajax-id="<?=$bxajaxid?>" id="ajax_press" data-show-more="<?=$arResult["NAV_RESULT"]->NavNum?>" data-next-page="<?=($arResult["NAV_RESULT"]->NavPageNomer + 1)?>" data-max-page="<?=$arResult["NAV_RESULT"]->nEndPage?>" class="button-more--friends button button_big">Показать еще</button>
		</div>
	<?endif;?>
	
	
    <?if(!$_GET["bxajaxid"]):?>
          		</div>
			</div>
		</div>
	</section>

</div>
<?else: exit;?>
<?endif;?>


<?else: exit;?>
<?endif;?>






