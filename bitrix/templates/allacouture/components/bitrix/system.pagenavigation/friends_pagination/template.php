<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
if($arResult["NavPageCount"] > 1)
{
	$bFirst = true;
?>
<?$this->SetViewTarget('SHOW_ALL');?>
	<?if($arResult['nEndPage'] >= ($arResult["NavPageNomer"]+1)):
		$str = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1);?>
		<button onclick="window.location.href='<?=$str;?>'" class="section__showmore button button_big">Показать еще</button>
	<?endif;?>
<?$this->EndViewTarget();?>


<div class="friends__catalog-pagination pagination">
<?
if($arResult["bDescPageNumbering"] === true):
	if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
		if($arResult["bSavePage"]):
?>
			
			<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><<</a>
<?
		else:
			if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):
?>
			<a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><<</a>
<?
			else:
?>
			<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><<</a>
<?
			endif;
		endif;
		?>
		<?
		
		if ($arResult["nStartPage"] < $arResult["NavPageCount"]):
			if($arResult["bSavePage"]):
?>
			<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>">1</a>
<?
			else:
?>
			<a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a>
<?
			endif;
?>
<?
			if ($arResult["nStartPage"] < ($arResult["NavPageCount"] - 1)):
?>
			<span>...</span>
<?
			endif;
		endif;
	endif;
	do
	{
		$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;
		
		if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
?>
		<a class="<?=($bFirst ? "pagination__link " : "")?>pagination__link_current"><?=$NavRecordGroupPrint?></a>
<?
		elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):
?>
		<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="<?=($bFirst ? "pagination__link" : "")?>"><?=$NavRecordGroupPrint?></a>
<?
		else:
?>
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"<?
			?> class="<?=($bFirst ? "pagination__link" : "")?>"><?=$NavRecordGroupPrint?></a>
		
<?
		endif;
		?>
		<span class="blog-vert-separator">|</span>
		<?
		
		$arResult["nStartPage"]--;
	} while($arResult["nStartPage"] >= $arResult["nEndPage"]);
	
	if ($arResult["NavPageNomer"] > 1):
		if ($arResult["nEndPage"] > 1):
			if ($arResult["nEndPage"] > 2):
?>
		<span>...</span>
<?
			endif;
?>
		<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=$arResult["NavPageCount"]?></a>
<?
		endif;
	
?>
		<a class="pagination__link"href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">>></a>
<?
	endif; 

else:

	if ($arResult["NavPageNomer"] > 1):
		if($arResult["bSavePage"]):
?>
			<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><<</a>
<?
		else:
			if ($arResult["NavPageNomer"] > 2):
?>
			<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><<</a>
<?
			else:
?>
			<a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><<</a>
<?
			endif;

		endif;
?>
<?
		
		if ($arResult["nStartPage"] > 1):
			if($arResult["bSavePage"]):
?>
			<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1">1</a>
<?
			else:
?>
			<a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a>
<?
			endif;
?>
<?
			if ($arResult["nStartPage"] > 2):
?>
			<span>...</span>
<?
			endif;
		endif;
	endif;

	do
	{
		if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
?>
		<a class="<?=($bFirst ? "pagination__link " : "")?>pagination__link_current"><?=$arResult["nStartPage"]?></a>
<?
		elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
?>
		<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="<?=($bFirst ? "pagination__link" : "")?>"><?=$arResult["nStartPage"]?></a>
<?
		else:
?>
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"<?
			?> class="<?=($bFirst ? "pagination__link" : "")?>"><?=$arResult["nStartPage"]?></a>
<?
		endif;
?>
<?
		$arResult["nStartPage"]++;
	} while($arResult["nStartPage"] <= $arResult["nEndPage"]);
	
	if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
		if ($arResult["nEndPage"] < $arResult["NavPageCount"]):
			if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)):
?>
		<span>...</span>
<?
			endif;
?>
		<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=$arResult["NavPageCount"]?></a>
<?
		endif;
?>
		<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">>></a>
<?
	endif;
endif;

if ($arResult["bShowAll"]):
	if ($arResult["NavShowAll"]):
?>
		<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0"><?=GetMessage("nav_paged")?></a>
<?
	else:
?>
		<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_all")?></a>
<?
	endif;
endif
?>
</div>
<?
}
?>