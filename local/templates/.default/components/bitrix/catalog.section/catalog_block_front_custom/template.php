<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if( count( $arResult["ITEMS"] ) >= 1 ){?>
	<div class="top_wrapper items_wrapper">
		<div class="fast_view_params" data-params="<?=urlencode(serialize($arTransferParams));?>"></div>
        <div class="bx_nav">
            <div class="bx_nav_prev bx_nav_arrow"></div>
            <div class="bx_nav_next bx_nav_arrow"></div>
        </div>
		<div class="catalog_block items row margin0">
		<?foreach($arResult["ITEMS"] as $arItem){?>

			<?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

			$totalCount = CNext::GetTotalCount($arItem, $arParams);
			$arQuantityData = CNext::GetQuantityArray($totalCount);

			$item_id = $arItem["ID"];
			$strMeasure = '';
			if($arParams["SHOW_MEASURE"] == "Y" && $arItem["CATALOG_MEASURE"]){
				if(isset($arItem["ITEM_MEASURE"]) && (is_array($arItem["ITEM_MEASURE"]) && $arItem["ITEM_MEASURE"]["TITLE"]))
				{
					$strMeasure = $arItem["ITEM_MEASURE"]["TITLE"];
				}
				else
				{
					$arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arItem["CATALOG_MEASURE"]), false, false, array())->GetNext();
					$strMeasure = $arMeasure["SYMBOL_RUS"];
				}
			}
			$arAddToBasketData = CNext::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, array(), 'small', $arParams);
			switch ($arParams["LINE_ELEMENT_COUNT"]){
				case '2':
					$col=6;
					break;
				case '4':
					$col=3;
					break;
				default:
					$col=4;
					break;
			}
			$elementName = ((isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arItem['NAME']);
			?>

			<div class="catalog_item_wrapp col-m-20 col-lg-<?=$col;?> col-md-4 col-sm-<?=floor(12 / round($arParams['LINE_ELEMENT_COUNT'] / 2))?> item" data-col="<?=$col;?>">
				<div class="catalog_item item_wrap " id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="inner_wrap">
						<div class="image_wrapper_block shine">
							<div class="stickers">
								<?$prop = ($arParams["STIKERS_PROP"] ? $arParams["STIKERS_PROP"] : "HIT");?>
									<?foreach(CNext::GetItemStickers($arItem["PROPERTIES"][$prop]) as $arSticker):?>
										<div><div class="<?=$arSticker['CLASS']?>"><?=$arSticker['VALUE']?></div></div>
									<?endforeach;?>
								<?if($arParams["SALE_STIKER"] && $arItem["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"]){?>
									<div><div class="sticker_sale_text"><?=$arItem["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"];?></div></div>
								<?}?>
							</div>
							<?if($arParams["DISPLAY_WISH_BUTTONS"] != "N" || $arParams["DISPLAY_COMPARE"] == "Y"):?>
								<div class="like_icons">
									<?if($arParams["DISPLAY_WISH_BUTTONS"] == "Y" && !$arItem["OFFERS"]):?>
										<div class="wish_item_button" <?=(CNext::checkShowDelay($arParams, $totalCount, $arItem) ? '' : 'style="display:none"');?>>
											<span title="<?=GetMessage('CATALOG_WISH')?>" class="wish_item to" data-item="<?=$arItem["ID"]?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>"><i></i></span>
											<span title="<?=GetMessage('CATALOG_WISH_OUT')?>" class="wish_item in added" style="display: none;" data-item="<?=$arItem["ID"]?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>"><i></i></span>
										</div>
									<?endif;?>
									<?if($arParams["DISPLAY_COMPARE"] == "Y"):?>
										<div class="compare_item_button">
											<span title="<?=GetMessage('CATALOG_COMPARE')?>" class="compare_item to" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arItem["ID"]?>" ><i></i></span>
											<span title="<?=GetMessage('CATALOG_COMPARE_OUT')?>" class="compare_item in added" style="display: none;" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arItem["ID"]?>"><i></i></span>
										</div>
									<?endif;?>
								</div>
							<?endif;?>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb" id="q<? echo $arItem['ID']; ?>">
								<?
								$a_alt = ($arItem["PREVIEW_PICTURE"] && strlen($arItem["PREVIEW_PICTURE"]['DESCRIPTION']) ? $arItem["PREVIEW_PICTURE"]['DESCRIPTION'] : ($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] : $arItem["NAME"] ));
								$a_title = ($arItem["PREVIEW_PICTURE"] && strlen($arItem["PREVIEW_PICTURE"]['DESCRIPTION']) ? $arItem["PREVIEW_PICTURE"]['DESCRIPTION'] : ($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] : $arItem["NAME"] ));
								?>
<?$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
$arFilter = Array("IBLOCK_ID"=>IntVal(29),"ID"=>$arItem['ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement()){ 
 $arFields = $ob->GetFields();  

 $arProps = $ob->GetProperties();

}

$URL = CFile::GetPath($arProps[MORE_PHOTO][VALUE][1]);
$URL2 = CFile::GetPath($arProps[MORE_PHOTO][VALUE][0]);

?>
								<?if( !empty($arItem["PREVIEW_PICTURE"]) ):?>
									<img class="noborder"  src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
									<img   id="q<? echo $arItem['ID']; ?>FOTO" class="second " src="<?=$URL?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
								<?elseif( !empty($arItem["DETAIL_PICTURE"])):?>
									<?$img = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array( "width" => 400, "height" => 400), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
									<img class="noborder"  src="<?=$img["src"]?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
									<img   id="q<? echo $arItem['ID']; ?>FOTO" class="second " src="<?=$URL?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
								<?else:?>
									<img class="noborder" src="<?=$URL2?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
									<img  id="q<? echo $arItem['ID']; ?>FOTO" class="second " src="<?=$URL?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
								<?endif;?>
								<?if($fast_view_text_tmp = CNext::GetFrontParametrValue('EXPRESSION_FOR_FAST_VIEW'))
									$fast_view_text = $fast_view_text_tmp;
								else
									$fast_view_text = GetMessage('FAST_VIEW');?>
							</a>

						</div>
						<style>
#q<? echo $arItem['ID']; ?>FOTO{
opacity:0;}
#q<? echo $arItem['ID']; ?>:hover img.noborder{
opacity:0;
}
#q<? echo $arItem['ID']; ?>:hover img.second{
opacity:1;
}
</style>
<div class="item_info">
							<?/*<div class="item-title">
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="dark_link"><span><?=$elementName;?></span></a>
							</div>*/?>
                            <div class="item-title">
                                <span><?=$arItem['DISPLAY_PROPERTIES']['CML2_ARTICLE']['VALUE'];?></span>
                            </div>
							<?if($arParams["SHOW_RATING"] == "Y"):?>
								<div class="rating">
									<?$APPLICATION->IncludeComponent(
									   "bitrix:iblock.vote",
									   "element_rating_front",
									   Array(
										  "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
										  "IBLOCK_ID" => $arItem["IBLOCK_ID"],
										  "ELEMENT_ID" =>$arItem["ID"],
										  "MAX_VOTE" => 5,
										  "VOTE_NAMES" => array(),
										  "CACHE_TYPE" => $arParams["CACHE_TYPE"],
										  "CACHE_TIME" => $arParams["CACHE_TIME"],
										  "DISPLAY_AS_RATING" => 'vote_avg'
									   ),
									   $component, array("HIDE_ICONS" =>"Y")
									);?>
								</div>
							<?endif;?>
							<?=$arQuantityData["HTML"];?>
							<div class="cost prices clearfix">
								<?if( $arItem["OFFERS"]){?>
									<?\Aspro\Functions\CAsproSku::showItemPrices($arParams, $arItem, $item_id, $min_price_id, array(), ($arParams["SHOW_DISCOUNT_PERCENT_NUMBER"] == "Y" ? "N" : "Y"));?>
								<?}else{?>
									<?
									$item_id = $arItem["ID"];
									if(isset($arItem['PRICE_MATRIX']) && $arItem['PRICE_MATRIX']) // USE_PRICE_COUNT
									{?>
										<?if($arItem['ITEM_PRICE_MODE'] == 'Q' && count($arItem['PRICE_MATRIX']['ROWS']) > 1):?>
											<?=CNext::showPriceRangeTop($arItem, $arParams, GetMessage("CATALOG_ECONOMY"));?>
										<?endif;?>
										<?=CNext::showPriceMatrix($arItem, $arParams, $strMeasure, $arAddToBasketData);?>
										<?$arMatrixKey = array_keys($arItem['PRICE_MATRIX']['MATRIX']);
										$min_price_id=current($arMatrixKey);?>
									<?
									}
									elseif($arItem["PRICES"])
									{
										$arCountPricesCanAccess = 0;
										$min_price_id=0;?>
										<?\Aspro\Functions\CAsproItem::showItemPrices($arParams, $arItem["PRICES"], $strMeasure, $min_price_id, ($arParams["SHOW_DISCOUNT_PERCENT_NUMBER"] == "Y" ? "N" : "Y"));?>
									<?}?>
								<?}?>
							</div>
							<?if($arParams["SHOW_DISCOUNT_TIME"]=="Y"){?>
								<?$arDiscounts = CCatalogDiscount::GetDiscountByProduct($item_id, $USER->GetUserGroupArray(), "N", $min_price_id, SITE_ID);
								$arDiscount=array();
								if($arDiscounts)
									$arDiscount=current($arDiscounts);
								if($arDiscount["ACTIVE_TO"]){?>
									<div class="view_sale_block <?=($arQuantityData["HTML"] ? '' : 'wq');?>">
										<div class="count_d_block">
											<span class="active_to hidden"><?=$arDiscount["ACTIVE_TO"];?></span>
											<div class="title"><?=GetMessage("UNTIL_AKC");?></div>
											<span class="countdown values"><span class="item"></span><span class="item"></span><span class="item"></span><span class="item"></span></span>
										</div>
										<?if($arQuantityData["HTML"]):?>
											<div class="quantity_block">
												<div class="title"><?=GetMessage("TITLE_QUANTITY_BLOCK");?></div>
												<div class="values">
													<span class="item">
														<span class="value"><?=$totalCount;?></span>
														<span class="text"><?=GetMessage("TITLE_QUANTITY");?></span>
													</span>
												</div>
											</div>
										<?endif;?>
									</div>
								<?}?>
							<?}?>
						</div>
							
						<div class="footer_button" style="display: none">
							<div class="counter_wrapp">
								<div class="button_block">
									<!--noindex-->
										<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="btn btn-default basket read_more"><?=\Bitrix\Main\Config\Option::get('aspro.next', "EXPRESSION_READ_MORE_OFFERS_DEFAULT", GetMessage("CATALOG_READ_MORE"));?></a>
									<!--/noindex-->
								</div>
							</div>
						</div>
<div class="fast_view_block" style="display: none" data-event="jqm" data-param-form_id="fast_view" data-param-iblock_id="<?=$arParams["IBLOCK_ID"];?>" data-param-id="<?=$arItem["ID"];?>" data-param-item_href="<?=urlencode($arItem["DETAIL_PAGE_URL"]);?>" data-name="fast_view"><?=$fast_view_text;?></div>
					</div>
				</div>
			</div>
		<?}?>
		</div>
	</div>
    <script>
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
            $('.items_wrapper .bx_nav').remove();
        } else {
            var width = $('.tabs_content').width();
            var width20;
            var maxSlides;
            if (width < 700) {
                width20 = width / 2;
                maxSlides = 2;
            } else {
                width20 = width / 5;
                maxSlides = 5;
            }
            $('.catalog_block').each(function () {
                if (!($(this).hasClass('bx_slider_active'))) {
                    var nav = $(this).siblings('.bx_nav');
                    var prev = $(nav).find('.bx_nav_prev');
                    var next = $(nav).find('.bx_nav_next');
                    $(this).addClass('bx_slider_active');
                    var slider = $(this).bxSlider({
                        slideWidth: width20,
                        minSlides: maxSlides,
                        maxSlides: maxSlides,
                        nextSelector: next,
                        nextText: '>',
                        prevSelector: prev,
                        prevText: '<',
                        touchEnabled: false,
                        onSliderLoad: function () {
                            var wrapper = $(this).parents('.bx-wrapper');
                            var width = $(wrapper).css('max-width');
                            var maxWidth = Math.floor(Number(width.replace('px', '')) / 100);
                            if (maxWidth > 9) {
                                maxWidth = 8;
                            }
                            $(this).parents('.bx-wrapper').css('margin-right', maxWidth + 'px');
                        }
                    });
                }
            });
        }
    </script>
<?}?>
