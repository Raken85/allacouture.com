<?
	if (is_array($arResult["GRID"]["ROWS"]))
	{
		usort($arResult["GRID"]["ROWS"], 'CNext::cmpByID');
		$arImages = array();
		foreach($arResult["GRID"]["ROWS"] as $key=>$arItem)
		{
			// fix bitrix measure bug
			if(!isset($arItem["MEASURE"]) && !isset($arItem["MEASURE_RATIO"]) && strlen($arItem["MEASURE_TEXT"])){
				$arResult["GRID"]["ROWS"][$key]["MEASURE_RATIO"] = 1;
			} 
			
			//fix image size
			if (isset($arItem["PREVIEW_PICTURE"]) && intval($arItem["PREVIEW_PICTURE"]) > 0)
			{	
				$arImage = CFile::GetFileArray($arItem["PREVIEW_PICTURE"]);
				if ($arImage)
				{
					$arFileTmp = CFile::ResizeImageGet( $arImage, array("width" => $arParams["PICTURE_WIDTH"], "height" =>$arParams["PICTURE_HEIGHT"]), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					$picture = array();
					foreach($arFileTmp as $name => $value) { $picture[strToUpper($name)] = $value; }
					$arResult["GRID"]["ROWS"][$key]["PREVIEW_PICTURE"]  = $picture;
				}
			}
			if (isset($arItem["DETAIL_PICTURE"]) && intval($arItem["DETAIL_PICTURE"]) > 0)
			{
				$arImage = CFile::GetFileArray($arItem["DETAIL_PICTURE"]);
				if ($arImage)
				{
					$arFileTmp = CFile::ResizeImageGet($arImage, array("width" => $arParams["PICTURE_WIDTH"], "height" =>$arParams["PICTURE_HEIGHT"]), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					$picture = array();
					foreach($arFileTmp as $name => $value) { $picture[strToUpper($name)] = $value; }
					$arResult["GRID"]["ROWS"][$key]["DETAIL_PICTURE"]  = $picture;
				}
			}
			if(strpos($arItem["PRODUCT_XML_ID"], "#")!==false){
				$arXmlID=explode("#", $arItem["PRODUCT_XML_ID"]);
				$arItem1 =CNextCache::CIBLockElement_GetList(array('CACHE' => array("MULTI"=>"N", "TAG" => CNextCache::GetIBlockCacheTag($arItem["IBLOCK_ID"]))), array("IBLOCK_ID" => $arItem["IBLOCK_ID"], "ACTIVE"=>"Y", "ACTIVE_DATE" => "Y", "XML_ID" => $arXmlID[0]), false, false, array("ID", "IBLOCK_ID"));
				$arResult["GRID"]["ROWS"][$key]["IBLOCK_ID"]=$arItem1["IBLOCK_ID"];
				$arResult["ITEMS_IBLOCK_ID"]=$arItem1["IBLOCK_ID"];
			}
		}
		foreach($arResult["GRID"]["ROWS"] as $key=>$arItem)
		{
			if ($arImages[$key]["PREVIEW_PICTURE"]) {$arResult["GRID"]["ROWS"][$key]["PREVIEW_PICTURE"] = $arImages[$key]["PREVIEW_PICTURE"];}
			if ($arImages[$key]["DETAIL_PICTURE"]) {$arResult["GRID"]["ROWS"][$key]["DETAIL_PICTURE"] = $arImages[$key]["DETAIL_PICTURE"];}
			$symb = substr($arItem["PRICE_FORMATED"], strrpos($arItem["PRICE_FORMATED"], ' '));
			//if((int)$symb){
				$arResult["GRID"]["ROWS"][$key]["SUMM_FORMATED"]=$arItem["SUM"];
			/*}else{
				$arResult["GRID"]["ROWS"][$key]["SUMM_FORMATED"] = str_replace($symb, "", FormatCurrency($arItem["PRICE"]*$arItem["QUANTITY"], $arItem["CURRENCY"])).$symb;
			}*/
		}
		unset($arImages);
		
		$isPrice = false;
		$priceIndex = 0;
		foreach($arResult["GRID"]["HEADERS"] as $key => $arHeader)
		{
			if($arHeader["id"]=="PRICE") 
			{
				$isPrice = true; 
				$priceIndex = $key;
			}
		}
		
		foreach($arResult["GRID"]["HEADERS"] as $key => $arHeader)
		{
				if ($arHeader["id"]=="QUANTITY" && $isPrice && $priceIndex)
				{
					$arResult["GRID"]["HEADERS"] = array_merge(	array_slice($arResult["GRID"]["HEADERS"], 0, $priceIndex), 
								array(array("id"=>"SUMM", "name"=>"")), 
								array_slice($arResult["GRID"]["HEADERS"], $priceIndex, count($arResult["GRID"]["HEADERS"]))
							);
				}
		}
					
		foreach($arResult["GRID"]["HEADERS"] as $key => $arHeader)
		{
			switch($arHeader["id"])
			{
				case "DELETE": $arResult["GRID"]["HEADERS"][$key]["SORT"] = 100; break;	
				case "NAME": $arResult["GRID"]["HEADERS"][$key]["SORT"] = 200; break;	
				case "DISCOUNT": $arResult["GRID"]["HEADERS"][$key]["SORT"] = 300; break;		
				case "PROPS": $arResult["GRID"]["HEADERS"][$key]["SORT"] = 400; break;
				case "WEIGHT": $arResult["GRID"]["HEADERS"][$key]["SORT"] = 500; break;
				case "PRICE": $arResult["GRID"]["HEADERS"][$key]["SORT"] = 600; break;
				case "QUANTITY": $arResult["GRID"]["HEADERS"][$key]["SORT"] = 700; break;
				case "SUMM": $arResult["GRID"]["HEADERS"][$key]["SORT"] = 800; break;
				case "DELAY": $arResult["GRID"]["HEADERS"][$key]["SORT"] = 1000; break;
				default :  $arResult["GRID"]["HEADERS"][$key]["SORT"] = 900; break;
			}

			if($arHeader["id"] == "PREVIEW_PICTURE")
				unset($arResult["GRID"]["HEADERS"][$key]);

		}
		usort($arResult["GRID"]["HEADERS"], 'CNext::cmpBySort');
		
		
		$arNormal = array();
		$arDelay = array();
		$arSubscribe = array();
		$arNa = array();	
		$arTotals = array();
		$arResult["DELAY_PRICE"]["SUMM"]=0;
			
		foreach ($arResult["GRID"]["ROWS"] as $k => $arItem)
		{
			if ($arItem["DELAY"] == "N" && $arItem["CAN_BUY"] == "Y")
			{
				$arNormal[$arItem["ID"]] = $arItem;  
			}
			if ($arItem["DELAY"] == "Y" && $arItem["CAN_BUY"] == "Y")
			{
				$arDelay[$arItem["ID"]] = $arItem;
				$arResult["DELAY_PRICE"]["SUMM"]+=$arItem["PRICE"];
				
			}
			if ($arItem["CAN_BUY"] == "N" && $arItem["SUBSCRIBE"] == "Y")
			{
				$arSubscribe[$arItem["ID"]] = $arItem;
			}
			if (isset($arItem["NOT_AVAILABLE"]) && $arItem["NOT_AVAILABLE"] == true)
			{
				$arNa[$arItem["ID"]] = $arItem;
			}
		}
		
		foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader)	{	if ($arHeader["id"] == "WEIGHT"){ $bWeightColumn = true;}	}
		 
		if ($bWeightColumn) { $arTotal["WEIGHT"]["NAME"] = GetMessage("SALE_TOTAL_WEIGHT"); $arTotal["WEIGHT"]["VALUE"] = $arResult["allWeight_FORMATED"];}
		if ($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") 
		{ 
			$arTotal["VAT_EXCLUDED"]["NAME"] = GetMessage("SALE_VAT_EXCLUDED"); $arTotal["VAT_EXCLUDED"]["VALUE"] = $arResult["allSum_wVAT_FORMATED"];
			$arTotal["VAT_INCLUDED"]["NAME"] = GetMessage("SALE_VAT_INCLUDED"); $arTotal["VAT_INCLUDED"]["VALUE"] = $arResult["allVATSum_FORMATED"];
		}
		if (doubleval($arResult["DISCOUNT_PRICE_ALL"]) > 0)
		{
			$arTotal["PRICE"]["NAME"] = GetMessage("SALE_TOTAL"); 
			$arTotal["PRICE"]["VALUES"]["ALL"] = str_replace(" ", "&nbsp;", $arResult["allSum_FORMATED"]);
			$arTotal["PRICE"]["VALUES"]["WITHOUT_DISCOUNT"] = $arResult["PRICE_WITHOUT_DISCOUNT"];
		}
		else
		{
			$arTotal["PRICE"]["NAME"] = GetMessage("SALE_TOTAL"); 
			$arTotal["PRICE"]["VALUES"]["ALL"] = $arResult["allSum_FORMATED"];
		}

		$arNormal["COUNT"] = count($arNormal);
		$arNormal["TOTAL"] = $arTotal;
		
		$arDelay["COUNT"] = count($arDelay);
		$arSubscribe["COUNT"] = count($arSubscribe);
		$arNa["COUNT"] = count($arNa);

		$arResult["DELAY_PRICE"]["SUMM_FORMATED"]=CCurrencyLang::CurrencyFormat($arResult["DELAY_PRICE"]["SUMM"], CSaleLang::GetLangCurrency(SITE_ID), true);
		
		$arJson = array();
		if ($arNormal["COUNT"]) { $arJson[]= array("AnDelCanBuy"=>$arNormal); }
		if ($arDelay["COUNT"]) { $arJson[]= array("DelDelCanBuy"=>$arDelay); }
		if ($arSubscribe["COUNT"]) { $arJson[]= array("ProdSubscribe"=>$arSubscribe); }
		if ($arNa["COUNT"]) { $arJson[]= array("nAnCanBuy"=>$arNa); }
		
		$arResult["JSON"] = $arJson;
	}

    $itemIDS = array();
    $sectionIDS = array();
    $elementIDS = array();
    $iblockIDS = array();
    $items = array();
    foreach ($arResult['GRID']['ROWS'] as $arItem) {
        $itemIDS[] = $arItem['PRODUCT_ID'];
        $items[$arItem['PRODUCT_ID']] = $arItem['PRODUCT_ID'];
    }
    $arFilter = array('ID' => $itemIDS);
    $arSelect = array('ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'PROPERTY_CML2_LINK');
    $rsItem = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($arItem = $rsItem->GetNext()) {
        $elementIDS[] = $arItem['PROPERTY_CML2_LINK_VALUE'];
        $items[$arItem['ID']] = $arItem['PROPERTY_CML2_LINK_VALUE'];
    }
    $arFilter = array('ID' => $elementIDS);
    $arSelect = array('ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID');
    $rsItem = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($arItem = $rsItem->GetNext()) {
        $sectionIDS[] = $arItem['IBLOCK_SECTION_ID'];
        foreach ($items as &$item) {
            if ($item == $arItem['ID']) {
                $item = $arItem['IBLOCK_SECTION_ID'];
            }
        }
    }
    $arFilter = array('ID' => $sectionIDS, 'IBLOCK_ID' => $iblockIDS);
    $arSelect = array('ID', 'NAME');
    $rsSections = CIBlockSection::GetList(array(), $arFilter, false, $arSelect, false);
    while ($arSection = $rsSections->GetNext()) {
        foreach ($items as &$item) {
            if ($item == $arSection['ID']) {
                $item = $arSection['NAME'];
            }
        }
    }

    $terminationName = array(
        'Юбки' => 'Юбка',
        'Накидки' => 'Накидка',
        'Платья' => 'Платье',
        'Комбинезоны' => 'Комбинезон',
        'Блузки' => 'Блузка',
        'Топы' => 'Топ',
        'Жакеты' => 'Жакет',
        'Жилеты' => 'Жилет',
        'Купальники' => 'Купальник',
        'Костюмы' => 'Костюм'
    );
    foreach ($arResult['GRID']['ROWS'] as &$arItem) {
        $sectionName = $items[$arItem['PRODUCT_ID']];
        if (array_key_exists($sectionName, $terminationName)) {
            $sectionName = $terminationName[$sectionName];
        }
        $arItem['SECTION_NAME'] = $sectionName;
    }
?>