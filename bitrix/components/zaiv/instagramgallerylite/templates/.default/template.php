<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if($arParams[NOINDEX_WIDGET]=="Y"){?><!--googleoff: all--><!--noindex--><?}?>
<div class="zaiv-instagram-gallery-container">
	<?if(!$arResult[ERROR]){?>
		<div class="zaiv-instagram-gallery-media">
			<?foreach($arResult[ITEMS] as $arItem){?>
				<a 
					href="<?=($arParams["SHOW_TYPE"]=="WEBSITE")?$arItem[IMAGE_DETAIL]:$arItem[LINK]?>" 
					<?=($arParams[NOINDEX_LINKS]=="Y")?'rel="nofollow"':''?> 
					target="_blank"  
					style="background-image:url(<?=$arItem[IMAGE_PREVIEW]?>)"
					<?=($arParams[SHOW_DESCRIPTION]=="Y")?'data-caption="'.$arItem[DESCRIPTION].'"':''?>
					<?=($arParams[SHOW_DESCRIPTION]=="Y")?'title="'.$arItem[DESCRIPTION].'"':''?>
				>
				</a>
			<?}?>
		</div>
	<?}else{
		echo "Error in parameters";
	}?>
</div>
<?if($arParams[NOINDEX_WIDGET]=="Y"){?><!--/noindex--><!--googleon: all--><?}?>

<?if($arParams[SHOW_TYPE] == "WEBSITE"){?>
	<script>
		$(document).ready(function(){
		<?
			switch($arParams[PLUGIN_TYPE]){
				case "FANCYBOX3":
					?>
					$('.zaiv-instagram-gallery-media a').attr("data-type","image");
					var $links = $('.zaiv-instagram-gallery-media a');
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
					$('.zaiv-instagram-gallery-media').magnificPopup({
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