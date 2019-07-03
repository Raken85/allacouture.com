<?php
AddEventHandler("main", "OnBeforeUserRegister", Array("MyClass", "OnBeforeUserRegisterHandler"));
class MyClass 
{ 
   function OnBeforeUserRegisterHandler(&$arFields) 
    { 
          $arFields["LOGIN"] = $arFields["EMAIL"]; 
    } 
}

function my_onAfterResultAddUpdate($WEB_FORM_ID, $RESULT_ID){
  // действие обработчика распространяется только на форму с ID=4
  if ($WEB_FORM_ID == 4) {
	$arAnswer = CFormResult::GetDataByID($RESULT_ID,array("EMAIL","CLIENT_NAME"), $arResult, $arAnswer2);
	if($arAnswer["EMAIL"]["0"]["USER_TEXT"]){
		$filter = array("EMAIL"=>trim($arAnswer["EMAIL"]["0"]["USER_TEXT"]));
		$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter);
		if($arUser = $rsUsers->Fetch()){
			
		}else{
			$user = new CUser;
			$arFields = array(
				"NAME"=>trim($arAnswer["CLIENT_NAME"]["0"]["USER_TEXT"]),
				"LOGIN"=>trim($arAnswer["EMAIL"]["0"]["USER_TEXT"]),
				"EMAIL"=>trim($arAnswer["EMAIL"]["0"]["USER_TEXT"]),
				"PASSWORD"=>md5($arAnswer["EMAIL"]["0"]["USER_TEXT"]),
				"CONFIRM_PASSWORD"=>md5($arAnswer["EMAIL"]["0"]["USER_TEXT"]),
			);
			$ID = $user->Add($arFields);
			if (intval($ID) > 0){
				CUser::SendUserInfo($ID, "s2", "Вы были зарегистрованы на сайте AllaCouture", true);
			}
		}
	}

  }
}
AddEventHandler('form', 'onAfterResultAdd', 'my_onAfterResultAddUpdate');

use Bitrix\Main\Loader,
    Bitrix\Main\EventManager;

Loader::registerAutoLoadClasses(
    null,
    array(
    '\PixelPlus\SeoTools' => '/bitrix/php_interface/include/pixelplus/classes/seotools.php'
    )
);

EventManager::getInstance()->addEventHandler('main', 'OnBeforeProlog', array('\PixelPlus\SeoTools', 'addCanonical'));

?>