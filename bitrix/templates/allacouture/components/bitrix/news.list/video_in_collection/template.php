<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
	<div class="slider slider_videos">
<?$i=1;?>
	<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="slider__slide" id="<?=$this->GetEditAreaId($arItem['ID']);?> <?=$i;?>">
				<div class="slider__videos-item">
						<?if($arItem["DISPLAY_PROPERTIES"]['VIDEO']):?>
							<?if($arItem['PROPERTIES']['VIDEO']['VALUE']){
							if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $arItem['PROPERTIES']['VIDEO']['VALUE'], $match)) {
								$video_id = $match[1];
							}
							?>
								<iframe  src="https://www.youtube.com/embed/<?=$video_id?>?rel=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
							<?}?>
						<?endif;?>
				</div>
			</div>
<?$i++;?>
	<?endforeach;?>
	</div>


<?if(count($arResult["ITEMS"]) > 1):?>
	<div class="slider slider_videos_thumb">
		<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
			<div class="slider__slide">
				<div class="slider_videos_thumb__img" style="background-image: url(
				<?
				$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 171, "height" => 88), BX_RESIZE_IMAGE_EXACT, false); 
				echo ''.$renderImage["src"].''; 
				?>
				)"></div>
			</div>
		<?endforeach;?>
	</div>
<?endif;?>
