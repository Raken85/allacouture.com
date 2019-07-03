<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<section class="page__section section section_small page-news" id="page-ajax">
	<div class="section__inner">
		<div class="section__content">
			<div class="catalog__header">
				<div class="catalog__view-options">
					<div class="news-ajax">
						<?= $arResult["NAV_STRING"] ?>
          			</div>
			
        		</div>
      		</div>

	  		<div class="slider slider_news slider_news_full">

		      	<?
		      		$count = 0; $width = 1; $height = 3; $slides = 5; $widthAdapt = false;
		      	?>
				<? if (!empty($_GET['PAGEN_1']) && $_GET['PAGEN_1'] != 1) { ?>
					<a href="/media/news/?PAGEN_1=<?= $arResult['NAV_RESULT']->NavPageNomer - 1 ?>" class="slick-prev slick-arrow news-ajax"></a>
				<? } ?>
		      	<div class="slider__slide ">

						<div class="news-list">
		      	<?
			      	foreach($arResult["ITEMS"] as $arItem) {
						$count++;
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						$timestamp = strtotime($arItem['TIMESTAMP_X']);
				?>
					<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="news-list__item news news_preview <? if ($height != $count) echo " news-list__item_left";  ?> <?if($count == $width_1) {echo 'news-list__item_full '; if(!$widthAdapt_1){$width_1+=5;$widthAdapt_1=true;}else{$width_1+=1;$widthAdapt_1=false;}} if($count == $width) {echo 'news-list__item_wide'; if(!$widthAdapt){$width+=4;$widthAdapt=true;}else{$width+=2;$widthAdapt=false;}}
        	    		if($height == $count) {echo 'news-list__item_vertical news-list__item_right'; $height += 6;}?>" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>);" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        		      	<span class="news__content">
        		      	  	<span class="news__content-date"><?=date('d.m.Y', $timestamp)?></span>
        		      	  	<span class="news__header">
        		      	  	  	<?echo $arItem["NAME"];?>
        		      	  	</span>
        		      	  	<span class="news__announce">
        		      	  	  	<?$arItem["PREVIEW_TEXT"] = strip_tags($arItem["PREVIEW_TEXT"]);
                            echo (strlen($arItem["PREVIEW_TEXT"])>50)?substr($arItem["PREVIEW_TEXT"], 0, 50).'...':$arItem["PREVIEW_TEXT"];?>
        		      	  	</span>
        		      	  	<span class="news__hover-link">
        		      	  	  	Подробнее
        		      	  	</span>
        		      	</span>
        		    </a>
		        	<?}
			        if($count == $slides):?></div>
		        </div>
				<a href="/media/news/?PAGEN_1=<?= $arResult['NAV_RESULT']->NavPageNomer + 1 ?>" class="slick-next slick-arrow news-ajax"></a>
		        	<?endif;?>
			</div>
			<?if($count == $slides):?>
				<a href="/media/news/?PAGEN_1=<?= $arResult['NAV_RESULT']->NavPageNomer + 1 ?>" class="section__showmore button button_big news__btn-more news-ajax">Показать еще</a>
			<?endif;?>
		</div>

	</div>
</section>
