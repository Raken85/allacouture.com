<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$notifyOption = COption::GetOptionString("sale", "subscribe_prod", "");
$arNotify = unserialize($notifyOption);
?>

<section class="page__section section">
	<div class="section__inner">
		<a class="section__header" href="#">
			бестселлеры
		</a>
		<div class="section__content">
			<div class="slider slider_products">

	<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
		<?
			$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
		?>
		
	
	<div class="slider__slide" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
		<div class="product product_slider-card">
			<div class="product__inner">
				<div class="product__left">
					<div class="product__thumbs">
							<?
							$LINE_ELEMENT_COUNT = 2; 
							if(count($arElement["MORE_PHOTO"])>0):?>
								<?$i=1;?>
								<?foreach($arElement["MORE_PHOTO"] as $PHOTO):?>
									<a href="#<?=$i;?>">
										<div class="product__thumb">
											<img src="<?=$PHOTO["SRC"]?>"  alt="<?=$arElement["NAME"]?>">
										</div>
									</a>
									<?$i++;?>
								<?endforeach?>
							<?endif?>	
					</div>
					<button class="product__icon product__icon_3dview">
						<span>3D вид</span>
					</button>
					<button class="product__icon product__icon_video">
						<span>Видео</span>
					</button>
					<div class="product__icons">
						<button class="product__icon product__icon_gift">
							<span>подарить</span>
						</button>
						<button class="product__icon product__icon_fav">
							<span>в избранное</span>
						</button>
						<button class="product__icon product__icon_compare">
							<span>в сравнение</span>
						</button>
					</div>
				</div>
				
				<div class="product__right">
                   <div class="product__badge product__badge_new"></div> 
<?/*if($arElement["DISPLAY_PROPERTIES"]['NEW']):?> 
	<div class="product__badge product__badge_new"></div> 
<?if($arElement['DISPLAY_PROPERTIES']['SALE']):?>
	<div class="product__badge product__badge_promo"></div>
<?elseif($arElement['DISPLAY_PROPERTIES']['EXS']):?>
	<div class="product__badge product__badge_exclamation"></div>
<?elseif($arElement['DISPLAY_PROPERTIES']['BSET']):?>
	<div class="product__badge product__badge_star"></div>
<?endif;*/?>







					
					
                    <a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="product__main-img">
						<?if (count ($arElement["MORE_PHOTO"]) > 0):?> 
							<?$i=1;?>
							<?foreach($arElement["MORE_PHOTO"] as $PHOTO):?>
								<div class="product__img" data-hash="<?=$i;?>">
									<img  src="<?=$PHOTO["SRC"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
								</div>
								<?$i++;?>
							<?endforeach?>
						<?endif;?>
                    </a>


                    <div class="product__description">
                      <div class="product__art">
                        Арт. <? echo $arElement['DISPLAY_PROPERTIES']['ARTIKUL']['DISPLAY_VALUE'];?>
                      </div>
                      <div class="product__art-avail">
                        <div class="product__avail">
                          В наличии <span>/ На заказ</span>
                        </div>
                        <div class="product__price">
                          3 233 ₽
                        </div>
                      </div>
                      <!-- <a href="#" class="product__name">
                        Columbia Women's Baddabing Hat
                      </a> -->
                      <div class="product__sizes">
                        <div class="product__size">XXXS</div>
                        <div class="product__size product__size_on">XXS</div>
                        <div class="product__size">XS</div>
                        <div class="product__size product__size_on">S</div>
                        <div class="product__size product__size_on">M</div>
                        <div class="product__size product__size_on">L</div>
                        <div class="product__size product__size_on">XL</div>
                        <div class="product__size">XXL</div>
                        <div class="product__size">XXXL</div>
                      </div>
                      <div class="product__btns">
                        <button class="product__addtocart button">В корзину</button>
                        <button class="product__buyoneclick button">Купить в 1 клик</button>
                        <button class="product__rent button" disabled>Прокат</button>
                        <button class="product__buycredit button">Купить в кредит</button>
                        <!-- <button class="product__sendgift button">Подарить</button> -->
                      </div>
                    </div>
                  </div>







            



			
		
				<?/*if(is_array($arElement["OFFERS"]) && !empty($arElement["OFFERS"]))  // Product has offers
				{
				if ($arElement["MIN_PRODUCT_OFFER_PRICE"] > 0):
				?>
					<?if (count($arElement["OFFERS"]) > 1) echo GetMessage("CATALOG_PRICE_FROM")?>
					<?=$arElement["MIN_PRODUCT_OFFER_PRICE_PRINT"];?>
					<?endif;?>
					<?
				}
				else  // Product doesn't have offers
				{
					$numPrices = count($arParams["PRICE_CODE"]);
					foreach($arElement["PRICES"] as $code=>$arPrice):?>
						<?if($arPrice["CAN_ACCESS"]):?>
							<?if ($numPrices>1):?>
							<?=$arResult["PRICES"][$code]["TITLE"];?>:<?endif?>
							<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
								<?=$arPrice["PRINT_DISCOUNT_VALUE"]?>
								<?=$arPrice["PRINT_VALUE"]?>
							<?else:?>
								<?=$arPrice["PRINT_VALUE"]?>
							<?endif;?>
						<?endif;?>
					<?endforeach;?>

					<?if($arElement["CAN_BUY"]):?>
						<a href="<?echo $arElement["ADD_URL"]?>" rel="nofollow" class="bt3 addtoCart" onclick="return addToCart(this, 'list', '<?=GetMessage("CATALOG_IN_CART")?>', 'noCart');" id="catalog_add2cart_link_<?=$arElement['ID']?>"><?=GetMessage("CATALOG_BUY")?></a>
					<?elseif ( $arNotify[SITE_ID]['use'] == 'Y'):?>
						<?if ($USER->IsAuthorized()):?>
							<noindex><a href="<?echo $arElement["SUBSCRIBE_URL"]?>" rel="nofollow" class="subscribe_link" onclick="return addToSubscribe(this, '<?=GetMessage("CATALOG_IN_SUBSCRIBE")?>');" id="catalog_add2cart_link_<?=$arElement['ID']?>"><?echo GetMessage("CATALOG_SUBSCRIBE")?></a></noindex>
						<?else:?>
							<noindex><a href="javascript:void(0)" rel="nofollow" class="subscribe_link" onclick="showAuthForSubscribe(this, <?=$arElement['ID']?>, '<?echo $arElement["SUBSCRIBE_URL"]?>')" id="catalog_add2cart_link_<?=$arElement['ID']?>"><?echo GetMessage("CATALOG_SUBSCRIBE")?></a></noindex>
						<?endif;?>
					<?endif;
				}
*/?>
			



			</div>
		</div>
	</div>
	<?endforeach; ?>

			</div>
		</div>
	</div>
</section>
