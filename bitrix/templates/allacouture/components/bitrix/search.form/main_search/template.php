<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>


          <form action="<?=$arResult["FORM_ACTION"]?>" class="search__form">
            <input type="text" name="q" value="" class="search__input" placeholder="Введите текст">
            <button name="s" type="submit" class="search__submit"></button>
          </form>
