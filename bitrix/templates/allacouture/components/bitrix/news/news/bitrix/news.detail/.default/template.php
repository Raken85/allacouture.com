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
$timestamp = strtotime($arResult['TIMESTAMP_X']);
?>
<section class="page__section section section_small page__section--new-detal">
  <div class="section__inner">
    <div class="section__content">
      <article class="news">
        <header class="news__header">
			<?if(isset($arResult['PREV_PAGE'])):?>
          		<a href="<?=$arResult['PREV_PAGE']?>" class="news__prev"></a>
          	<?endif;?>
          	<span class="news__title">
          	  	<?=$arResult['NAME']?>
          	</span>
          	<?if(isset($arResult['NEXT_PAGE'])):?>
          		<a href="<?=$arResult['NEXT_PAGE']?>" class="news__next"></a>
          	<?endif;?>
        </header>
        
        <div class="news__social news__social_desktop social social_black">
          	<span class="news__date">
          	  	<?=date('d.m.Y', $timestamp)?>
          	</span>
         	<div class="social__header">
         	  	Поделиться
         	</div>
         	
          	<div class="social__links">
          	  	<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
				<script src="//yastatic.net/share2/share.js"></script>
				<div class="ya-share2" data-services="gplus,twitter,facebook,vkontakte"></div>
          	</div>
        </div>
        <section class="news__text text">
          	<div class="text__floating text__floating_right text__video-wrap">
          		<?if(!empty($arResult['PROPERTIES']['VIDEO']['VALUE'])):?>
          	  		<div class="text__video">
          	  		  <?=$arResult['PROPERTIES']['VIDEO']['~VALUE'];?>
          	  		</div>
          	  	<?endif;?>
          	</div>

          	<?=$arResult['PREVIEW_TEXT']?>
<br>
          		<?if(!empty($arResult['PROPERTIES']['LINK']['VALUE'])):?>
<a href="<?=$arResult["PROPERTIES"]["LINK"]["VALUE"]?>" class="product__buyoneclick button">
							В каталог
						</a>
<?endif;?>

			<?if(!empty($arResult['SIZE_IMG'])):?>
          		<div class="news__gallery slider slider_gallery">
          			<?foreach ($arResult['SIZE_IMG'] as $original => $galleryImg):?>
          		  		<div class="slider__slide">
          		  		  	<a href="<?=CFile::GetPath($original);?>" data-fancybox="news-gallery-1">
          		  		  	  <img src="<?=$galleryImg['src']?>" alt="<?=$arResult['NAME']?>">
          		  		  	</a>
          		  		</div>
          		  	<?endforeach;?>
          		</div>
          	<?endif;?>


			<?if(!empty($arResult['DETAIL_PICTURE']['SRC'])):?>
          		<div class="text__floating text__floating_left">
          		  <img src="<?=$arResult['DETAIL_PICTURE']['SRC'];?>" alt="<?=$arResult['NAME']?>">
          		</div>
          	<?endif;?>

          	<?if(!empty($arResult['PROPERTIES']['TEXT_DESCRIPTION']['~VALUE']['TEXT'])):?>
          		<?=$arResult['PROPERTIES']['TEXT_DESCRIPTION']['~VALUE']['TEXT']?>
          	<?endif;?>

        </section>
        <?if(!empty($arResult['TAGS']) && is_array($arResult['TAGS'])):?>
        	<footer class="news__footer">
        		<?foreach ($arResult['TAGS'] as $key => $tag):?>
        	  		<a href="/news/?TAGS=<?=str_replace(" ", "", $tag);?>" class="news__tag">#<?=str_replace(" ", "", $tag);?></a>
        	  	<?endforeach;?>
        	</footer>
        <?endif;?>
        <div class="news__footer news__footer_mobile">
          <div class="news__social social social_black">
            <div class="social__header">
              	Поделиться
            </div>
            <div class="social__links">
				<div class="ya-share2" data-services="telegram,twitter,facebook,vkontakte,"></div>
            </div>
          </div>
          
        </div>
      </article>
    </div>
  </div>
</section>
