<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<section class="page__section section" id="page-ajax">
    <div class="section__inner section__inner_border_bottom">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => "/include/title_moda.php"
			)
		);?>
<div class="section__content">
	<div class="slider slider_news">
		<div class="slider__slide">
			<div class="news-list">
<?$i=1;?>		
<?foreach($arResult["ITEMS"] as $arItem):
	if ($i > 5) {
		break 1;
	}
?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	
	
<a href="<?=$arItem['DETAIL_PAGE_URL']?>" 
class="news-list__item <?=$i;/*?> 
<?if ($i=='1'):?>news-list__item_full news news_preview
<?elseif ($i=='2'):?>news-list__item_left news-list__item_wide news news_preview
<?elseif ($i=='3'):?> news-list__item_left news news_preview
<?elseif ($i=='4'):?>news-list__item_right news-list__item_vertical news news_preview
<?elseif ($i=='5'):?>news-list__item_left news news_preview
<?elseif ($i=='6'):?>news-list__item_left news-list__item_wide news news_preview<?endif;*/?>
<?if ($i=='1'):?>news news_preview news-list__item_left news-list__item_wide
<?elseif ($i=='2'):?>news news_preview news-list__item_left 
<?elseif ($i=='3'):?>news news_preview  news-list__item_vertical news-list__item_right
<?elseif ($i=='4'):?>news news_preview  news-list__item_left
<?elseif ($i=='5'):?>news news_preview  news-list__item_left news-list__item_wide<?endif;?>
" 



style="background-image: url(
<?/*if ($i=='1'):?>
	<?
	$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 1172, "height" => 492), BX_RESIZE_IMAGE_EXACT, false); 
	echo ''.$renderImage["src"].''; 
	?>
<?elseif ($i=='2'):?>
	<?
	$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 550, "height" => 270), BX_RESIZE_IMAGE_EXACT, false); 
	echo ''.$renderImage["src"].''; 
	?>
<?elseif ($i=='3'):?> 
	<?
	$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 287, "height" => 269), BX_RESIZE_IMAGE_EXACT, false); 
	echo ''.$renderImage["src"].''; 
	?>
<?elseif ($i=='4'):?>
	<?
	$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 287, "height" => 562), BX_RESIZE_IMAGE_EXACT, false); 
	echo ''.$renderImage["src"].''; 
	?>
<?elseif ($i=='5'):?>
	<?
	$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 287, "height" => 269), BX_RESIZE_IMAGE_EXACT, false); 
	echo ''.$renderImage["src"].''; 
	?>
<?elseif ($i=='6'):?>
	<?
	$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 550, "height" => 269), BX_RESIZE_IMAGE_EXACT, false); 
	echo ''.$renderImage["src"].''; 
	?>
<?endif;*/?>
<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>








);" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	<span class="news__content">
		<span class="news__header">
			<?echo $arItem["NAME"]?>
		</span>
		<span class="news__announce">
			<?$arItem["PREVIEW_TEXT"] = strip_tags($arItem["PREVIEW_TEXT"]);
                            echo (strlen($arItem["PREVIEW_TEXT"])>50)?substr($arItem["PREVIEW_TEXT"], 0, 50).'...':$arItem["PREVIEW_TEXT"];?>
		</span>
		<span class="news__hover-link">
			<?/*if ($arItem['DISPLAY_PROPERTIES']['NEW']['DISPLAY_VALUE']=='Да'):?>new collection<?else:?> <?echo GetMessage("ELEMENT_DETAIL");?><?endif;*/?>
			Подробнее
		</span>
		
	</span>
</a>
<?$i++;?>
<?endforeach;?>
			</div>
		</div>
	</div>
</div>
	</div>
</section>