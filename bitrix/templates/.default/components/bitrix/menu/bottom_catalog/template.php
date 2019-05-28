<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
//$this->setFrameMode(true);
$colmd = 12;
$colsm = 12;
?>
<?if($arResult):?>
	<?
	if(!function_exists("ShowSubItems2Catalog")){
		function ShowSubItems2Catalog($arItem){
			?>
			<?if($arItem["CHILD"]):?>
				<?$noMoreSubMenuOnThisDepth = false;
				$count = count($arItem["CHILD"]);?>
				<?$lastIndex = count($arItem["CHILD"]) - 1;?>
				<?$new_row = true;?>
				<?foreach($arItem["CHILD"] as $i => $arSubItem):?>
					<?if(!$i):?>
						<div class="wrap">
					<?endif;?>
						<?$bLink = strlen($arSubItem['LINK']);?>
							<?if($new_row):?>
							<div class="item-link">
							<?endif;?>
							<div class="item<?=($arSubItem["SELECTED"] ? " active" : "")?>">
								<div class="title">
									<?if($bLink):?>
										<a href="<?=$arSubItem['LINK']?>"><?=$arSubItem['TEXT']?></a>
									<?else:?>
										<span><?=$arSubItem['TEXT']?></span>
									<?endif;?>
								</div>
							</div>
						<?if(($i+1)%2!=0||$i==0):?>
						<?$new_row = false;?>
						<?else:?>
						<?$new_row = true;?>
						<?endif;?>
						<?if($i && $i === $lastIndex || $count == 1):?><?$new_row = true;?>
						<?endif;?>
					<?if($new_row):?>	
					</div>
					<?else:?>
					 / 
					<?endif;?>

						<?/*if(!$noMoreSubMenuOnThisDepth):?>
							<?ShowSubItems($arSubItem);?>
						<?endif;*/?>
						<?$noMoreSubMenuOnThisDepth |= CNext::isChildsSelected($arSubItem["CHILD"]);?>
					<?if($i && $i === $lastIndex || $count == 1):?>
						</div>
					<?endif;?>
				<?endforeach;?>
				
			<?endif;?>
			<?
		}
	}
	?>
	<div class="bottom-menu">
		<div class="items">
			<?$lastIndex = count($arResult) - 1;?>
			<?$new_row = true;?>
			<?foreach($arResult as $i => $arItem):?>
				<?if($i === 1):?>
					<div class="wrap">
				<?endif;?>
					<?$bLink = strlen($arItem['LINK']);?>
					<?if($new_row):?>
					<div class="item-link">
					<?endif;?>
						<div class="item<?=($arItem["SELECTED"] ? " active" : "")?>">
							<div class="title">
								<?if($bLink):?>
									<a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
								<?else:?>
									<span><?=$arItem['TEXT']?></span>
								<?endif;?>
							</div>
						</div>
						<?if($i%2!=0):?>
						<?$new_row = false;?>
						<?else:?>
						<?$new_row = true;?>
						<?endif;?>
					<?if($new_row):?>	
					</div>
					<?else:?>
					 / 
					<?endif;?>

				<?if($i && $i === $lastIndex):?>
					</div>
				<?endif;?>
				<?ShowSubItems2Catalog($arItem);?>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>