<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
	<?
	$previousLevel = 0;
	foreach($arResult as $arItem):?>
		<?if ($arItem["IS_PARENT"]):?>
		<?else:?>
			<?if ($arItem["PERMISSION"] > "D"):?>
				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<a href="<?=$arItem["LINK"]?>"class="menu__link"><?=$arItem["TEXT"]?></a>
				<?endif?>
			<?endif?>
		<?endif?>
	<?endforeach?>
<?endif?>