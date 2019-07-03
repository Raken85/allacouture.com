<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if($arParams[NOINDEX_WIDGET]=="Y"){?><!--googleoff: all--><!--noindex--><?}?>
<?foreach($arResult[ERRORS] as $errorItem){
	echo "<div class=\"zaiv-instagram-gallery-error\">$errorItem</div>";
}?>
<?if(!$arResult[ERRORS]){?>

<section class="page__section section section_bg_letters">
      <div class="section__inner section__inner_border_bottom">
        <a class="section__header" href="https://www.instagram.com/allacouture/">
          @allacouture <br>
          <?=GetMessage("TMBIT_INSTAGRAMPOSTS_MY_V")?>
        </a>
        <div class="section__content">
		<div class="instagram <?=$arParams["GALLERY_UID"]?>">
			<?foreach($arResult[ITEMS] as $arItem){?>


<div class="instagram__item">
              <img src="<?=$arItem[IMAGE_PREVIEW]?>">
            </div>


			<?}?>
</div>
        </div>
      </div>
    </section>



	<?if($arParams[NOINDEX_WIDGET]=="Y"){?><!--/noindex--><!--googleon: all--><?}?>
	
	<?if($arParams[SHOW_TYPE] == "WEBSITE"){?>
		<script>
			$(document).ready(function(){
			<?
				switch($arParams[PLUGIN_TYPE]){
					case "FANCYBOX3":
						?>
						$('.zaiv-instagram-gallery-media.<?=$arParams["GALLERY_UID"]?> a').attr("data-type","image");
						var $links = $('.zaiv-instagram-gallery-media.<?=$arParams["GALLERY_UID"]?> a');
						$links.on('click', function(){
							$.fancybox.open( $links,{
								buttons : [
									'fullScreen',
									'zoom',
									'close'
								]
							},$links.index(this));
							return false;
						});
						<?
						break;
					case "MAGNIFICPOPUP":
						?>
						$('.zaiv-instagram-gallery-media.<?=$arParams["GALLERY_UID"]?>').magnificPopup({
							delegate: 'a', 
							type: 'image',
							gallery:{
								enabled:true
							}
						});
						<?
						break;
				}
			?>
			});
		</script>
	<?}?>
<?}?>