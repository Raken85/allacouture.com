<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule("zaiv.instagramgallerylite")){
	if($this->StartResultCache()){
		$arParams["GALLERY_UID"] = "gallery".md5(rand(1,1000000000));
		if(!$arParams[SHOW_DESCRIPTION]) $arParams[SHOW_DESCRIPTION] = "Y";
		$arParams[MEDIA_COUNT] = intval($arParams[MEDIA_COUNT]);
		if(!$arParams[MEDIA_COUNT]) $arParams[MEDIA_COUNT] = 9;

		if(!$arParams[USERNAME]){
			$arResult[ERRORS][] = "ERROR. No username";
		}
		if(!ini_get('allow_url_fopen')){
			$arResult['ERRORS'][] = "ERROR. PHP allow_url_fopen param must be \"ON\"";
		}
		if($arParams[USERNAME] && ini_get('allow_url_fopen')){	
			if(strpos($arParams[USERNAME],"instagram.com") || strpos($arParams[USERNAME],"instagr.am")) {
				$arParams[USERNAME] = end(explode("/",trim($arParams[USERNAME]," /")));
				unset($tmpUserArray);
			}else{
				$arParams[USERNAME] = str_replace("/","",$arParams[USERNAME]);
			}

			$zaivInstagramGalleryliteObj = new CZaivInstagramgallerylite();
			$arResult = $zaivInstagramGalleryliteObj->getGallery($arParams);
			
			$arResult = $APPLICATION->ConvertCharsetArray($arResult, "UTF8", (LANG_CHARSET)?LANG_CHARSET:SITE_CHARSET);
		}
		$this->IncludeComponentTemplate();
	}
}
?>