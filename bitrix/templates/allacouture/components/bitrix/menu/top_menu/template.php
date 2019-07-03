<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<nav class="header__main-menu menu menu_main">

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</div></div></div>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<div class="<?if ($arItem["SELECTED"]):?>menu__item menu__item_submenu menu__item_active<?else:?>menu__item menu__item_submenu<?endif?>"><a href="<?=$arItem["LINK"]?>" class="menu__link"><?=$arItem["TEXT"]?></a>
				<div class="menu__submenu">
					<div class="menu__line">
		<?else:?>
			<div class="<?if ($arItem["SELECTED"]):?>menu__item menu__item_active<?else:?>menu__item<?endif?>"><a href="<?=$arItem["LINK"]?>" class="menu__link"><?=$arItem["TEXT"]?></a>
				<div class="menu__submenu">
					<div class="menu__line">
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>
				
			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<div class="<?if ($arItem["SELECTED"]):?>menu__item menu__item_active<?else:?>menu__item<?endif?>"><a href="<?=$arItem["LINK"]?>" class="menu__link"><?=$arItem["TEXT"]?></a></div>
			<?else:?>
				<a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>menu__link menu__subitem_active<?else:?>menu__link<?endif?>"><?=$arItem["TEXT"]?></a>
			<?endif?>
					
		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<div class="<?if ($arItem["SELECTED"]):?>menu__item menu__item_active<?else:?>menu__item<?endif?>"><a href="<?=$arItem["LINK"]?>" class="menu__link"><?=$arItem["TEXT"]?></a></div>
			<?else:?>
				<div class="<?if ($arItem["SELECTED"]):?>menu__item menu__item_active<?else:?>menu__item<?endif?>"><a href="<?=$arItem["LINK"]?>" class="menu__link"><?=$arItem["TEXT"]?></a></div>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</div></div></div>", ($previousLevel-1) );?>
<?endif?>

</nav>

<?endif?>