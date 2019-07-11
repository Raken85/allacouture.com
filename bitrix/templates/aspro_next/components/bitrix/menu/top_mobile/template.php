<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>
<?if($arResult):?>
	<div class="menu top">
		<ul class="top">
<li>

<a rel="nofollow" href="tel:+74951505498" class="dark-color parent">
<i class="svg svg-phone"></i><span>+7 (495) 150-54-98</span></a>


<i class="svg svg-whatsapp" style="
    background: url(/bitrix/templates/aspro_next/css/../images/svg/social/Whatsapp.svg) no-repeat;
    background-size: 16px;
    background-position: center;
    float: left;
    left: 8px;top: 18px;
    z-index: 9999;
    "></i>
<a href="whatsapp://send?phone=+79629624466" class="dark-color" style="
    left: 10px;
"target="_blank" rel="nofollow" title="WhatsApp">
<span> +7 (962) 962-44-66</span></a>

<p class="mob_menu_adress">
<span>Адрес</span><br>
109004 Москва<br>
ул. Николоямская, дом 52 стр.1
</p>
<p class="mob_menu_adress" style="background: unset;">
    U.A.E., Dubai,<br>
    Jumeirah one, La mer Central, 445-a unit
</p>
<p class="mob_menu_adress1">
<span>Режим работы</span><br>
по предварительной записи
</p>

</li>

			<?foreach($arResult as $arItem):?>
				<?$bShowChilds = $arParams['MAX_LEVEL'] > 1;?>
				<?$bParent = $arItem['CHILD'] && $bShowChilds;?>
			<li   class="<?if($arItem['SELECTED']){?>selected <?}?><?if($arItem['LINK'] == '/catalog/'){?> catalog_li <?}?>">
					<a class="dark-color<?=($bParent ? ' parent' : '')?>" href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>">
						<span><?=$arItem['TEXT']?></span>
						<?if($bParent):?>
							<span class="arrow"><i class="svg svg_triangle_right"></i></span>
						<?endif;?>
					</a>
					<?if($bParent):?>

						<ul class="dropdown">
							<!-- <li class="menu_back"><a href="" class="dark-color" rel="nofollow"><i class="svg svg-arrow-right"></i><?=GetMessage('NEXT_T_MENU_BACK')?></a></li> 
							<li class="menu_title"><a href="<?=$arItem['LINK'];?>"><?=$arItem['TEXT']?></a></li>-->
							<?foreach($arItem['CHILD'] as $arSubItem):?>
								<?$bShowChilds = $arParams['MAX_LEVEL'] > 2;?>
								<?$bParent = $arSubItem['CHILD'] && $bShowChilds;?>
								<li<?=($arSubItem['SELECTED'] ? ' class="selected"' : '')?>>
									<a class="dark-color<?=($bParent ? ' 222parent' : '')?>" href="<?=$arSubItem["LINK"]?>" title="<?=$arSubItem["TEXT"]?>">
										<span><?=$arSubItem['TEXT']?></span>
										<?if($bParent):?>
											<span class="arrow"><i class="svg svg_triangle_right"></i></span>
										<?endif;?>
									</a>
									<?if($bParent):?>
										<ul class="dropdown">
											<!--<li class="menu_back"><a href="" class="dark-color" rel="nofollow"><i class="svg svg-arrow-right"></i><?=GetMessage('NEXT_T_MENU_BACK')?></a></li>
											<li class="menu_title"><a href="<?=$arSubItem['LINK'];?>"><?=$arSubItem['TEXT']?></a></li> -->
											<?foreach($arSubItem["CHILD"] as $arSubSubItem):?>
												<?$bShowChilds = $arParams['MAX_LEVEL'] > 3;?>
												<?$bParent = $arSubSubItem['CHILD'] && $bShowChilds;?>
												<li<?=($arSubSubItem['SELECTED'] ? ' class="selected"' : '')?>>
													<a class="dark-color<?=($bParent ? ' parent22' : '')?> <?if($arItem['LINK'] == '/catalog/'){?> catalog_li <?}?>" href="<?=$arSubSubItem["LINK"]?>" title="<?=$arSubSubItem["TEXT"]?>">
														<span><?=$arSubSubItem['TEXT']?></span>
														<?if($bParent):?>
															<span class="arrow"><i class="svg svg_triangle_right"></i></span>
														<?endif;?>
													</a>
													<?if($bParent):?>
														<ul class="dropdown">
															<!-- <li class="menu_back"><a href="" class="dark-color" rel="nofollow"><i class="svg svg-arrow-right"></i><?=GetMessage('NEXT_T_MENU_BACK')?></a></li>
															<li class="menu_title"><a href="<?=$arSubSubItem['LINK'];?>"><?=$arSubSubItem['TEXT']?></a></li>-->
															<?foreach($arSubSubItem["CHILD"] as $arSubSubSubItem):?>
																<li<?=($arSubSubSubItem['SELECTED'] ? ' class="selected"' : '')?>>
																	<a class="dark-color" href="<?=$arSubSubSubItem["LINK"]?>" title="<?=$arSubSubSubItem["TEXT"]?>">
																		<span><?=$arSubSubSubItem['TEXT']?></span>
																	</a>
																</li>
															<?endforeach;?>
														</ul>
													<?endif;?>
												</li>
											<?endforeach;?>
										</ul>
									<?endif;?>
								</li>
							<?endforeach;?>
						</ul>
					<?endif;?>
				</li>
			<?endforeach;?>
		</ul>
	</div>
<?endif;?>
