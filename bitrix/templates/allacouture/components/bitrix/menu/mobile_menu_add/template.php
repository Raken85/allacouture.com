<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="menu__list menu__list_small">
<?foreach($arResult as $arItem):?>
	<?if (!empty($arItem["SELECTED"])):?>
		<li class="menu__item active"><a class="menu__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<?else:?>	
		<li class="menu__item"><a class="menu__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<?endif?>

<?endforeach?>
</ul>

<?endif?>