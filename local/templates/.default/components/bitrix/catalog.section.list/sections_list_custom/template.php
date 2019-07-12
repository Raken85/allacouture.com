<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->setFrameMode( true ); ?>
<?if($arResult["SECTIONS"]){?>
<div class="catalog_section_list row items flexbox catalog_section_list_ikonki">
	<?foreach( $arResult["SECTIONS"] as $arItems ){
		$this->AddEditAction($arItems['ID'], $arItems['EDIT_LINK'], CIBlock::GetArrayByID($arItems["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arItems['ID'], $arItems['DELETE_LINK'], CIBlock::GetArrayByID($arItems["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_SECTION_DELETE_CONFIRM')));
	?>
		<div class="item_block col-md-3 col-sm-6">
			<div class="section_item item" id="<?=$this->GetEditAreaId($arItems['ID']);?>">
				<div class="section_item_inner catalog_razdeli_ikonki">
						<?if ($arParams["SHOW_SECTION_LIST_PICTURES"]=="Y"):?>
							<?$collspan = 2;?>
							<div class="image">
								<?if($arItems["PICTURE"]["SRC"]):?>
									<?$img = CFile::ResizeImageGet($arItems["PICTURE"]["ID"], array( "width" => 220, "height" => 220 ), BX_RESIZE_IMAGE_EXACT, true );?>
									<a href="<?=$arItems["SECTION_PAGE_URL"]?>" class="thumb"><img src="<?=$img["src"]?>" alt="<?=($arItems["PICTURE"]["ALT"] ? $arItems["PICTURE"]["ALT"] : $arItems["NAME"])?>" title="<?=($arItems["PICTURE"]["TITLE"] ? $arItems["PICTURE"]["TITLE"] : $arItems["NAME"])?>" /></a>
								<?elseif($arItems["~PICTURE"]):?>
									<?$img = CFile::ResizeImageGet($arItems["~PICTURE"], array( "width" => 220, "height" => 220 ), BX_RESIZE_IMAGE_EXACT, true );?>
									<a href="<?=$arItems["SECTION_PAGE_URL"]?>" class="thumb"><img src="<?=$img["src"]?>" alt="<?=($arItems["PICTURE"]["ALT"] ? $arItems["PICTURE"]["ALT"] : $arItems["NAME"])?>" title="<?=($arItems["PICTURE"]["TITLE"] ? $arItems["PICTURE"]["TITLE"] : $arItems["NAME"])?>" /></a>
								<?else:?>
									<a href="<?=$arItems["SECTION_PAGE_URL"]?>" class="thumb"><img src="<?=SITE_TEMPLATE_PATH?>/images/catalog_category_noimage.png" alt="<?=$arItems["NAME"]?>" title="<?=$arItems["NAME"]?>" /></a>
								<?endif;?>
							</div>
						<?endif;?>
						<div class="section_info">
							<ul>
								<li class="name">
									<a href="<?=$arItems["SECTION_PAGE_URL"]?>" class="dark_link"><span><?=$arItems["NAME"]?></span></a>
								</li>
								<?if($arItems["SECTIONS"]){
									foreach( $arItems["SECTIONS"] as $arItem ){?>
										<li class="sect"><a href="<?=$arItem["SECTION_PAGE_URL"]?>" class="dark_link"><?=$arItem["NAME"]?><? echo $arItem["ELEMENT_CNT"]?'&nbsp;<span>'.$arItem["ELEMENT_CNT"].'</span>':'';?></a></li>
									<?}
								}?>
							</ul>
						</div>
					<?if($arParams["SECTIONS_LIST_PREVIEW_DESCRIPTION"]!="N"):?>
						<?$arSection = $section=CNextCache::CIBlockSection_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CNextCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('GLOBAL_ACTIVE' => 'Y', "ID" => $arItems["ID"], "IBLOCK_ID" => $arParams["IBLOCK_ID"]), false, array("ID", $arParams["SECTIONS_LIST_PREVIEW_PROPERTY"]));?>
						<?/*if ($arSection[$arParams["SECTIONS_LIST_PREVIEW_PROPERTY"]]):?>
							<tr><td class="desc" <?=($collspan? 'colspan="'.$collspan.'"':"");?>><span class="desc_wrapp"><?=$arSection[$arParams["SECTIONS_LIST_PREVIEW_PROPERTY"]]?></span></td></tr>
						<?else:?>
							<tr><td class="desc" <?=($collspan? 'colspan="'.$collspan.'"':"");?>><span class="desc_wrapp"><?=$arItems["DESCRIPTION"]?></span></td></tr>
						<?endif;*/?>
					<?endif;?>
				</div>
			</div>
		</div>
	<?}?>
</div>
<?}?>
