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
<?if(!empty($arResult['ITEMS'])):?>
<section class="page__section section">
  <div class="section__inner">
  	<?$APPLICATION->IncludeComponent(
      "bitrix:main.include",
      "",
      Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/about/press_title.php"
      )
    );?>
    <div class="section__content">
    	<div class="slider slider_press">
    	<?foreach($arResult["ITEMS"] as $arItem):?>
    		<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?> 		
      		<div class="slider__slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
      		  	<a class="press-card" href="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" data-fancybox="press">
      		  		<?if(!empty($arItem["SIZE_IMG"]["src"])):?>
      		  	  		<img src="<?=$arItem["SIZE_IMG"]["src"]?>" alt="<?echo $arItem["NAME"]?>">
      		  	  	<?endif;?>
      		  	  	<div class="press-card__text">
      		  	  	  	<span class="press-card__name"><?echo $arItem["NAME"]?></span>
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
<?endif;?>
