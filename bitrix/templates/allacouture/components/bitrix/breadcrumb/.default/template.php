<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()

$strReturn .= '<nav class="page__breadcrumbs breadcrumbs">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	$nextRef = ($index < $itemSize-2 && $arResult[$index+1]["LINK"] <> ""? ' itemref="bx_breadcrumb_'.($index+1).'"' : '');
	$child = ($index > 0? ' itemprop="child"' : '');
	$arrow = ($index > 0? '' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= $arrow.'
				<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="url" class="breadcrumbs__link">
					<span itemprop="title">'.$title.'</span>
				</a>';
	}
	else
	{
		$strReturn .= '<a href="javascript:void(0)" class="breadcrumbs__link breadcrumbs__link_current">
				'.$arrow.'
				<span>'.$title.'</span>
			</a>';
	}
}

$strReturn .= '</nav>';

return $strReturn;
