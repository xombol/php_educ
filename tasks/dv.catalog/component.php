<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if (!CModule::IncludeModule('iblock')) {
    ShowError('Модуль «Информационные блоки» не установлен. Решите проблему !' );
    return;
}

if (!isset($arParams['CACHE_TIME'])) {
    $arParams['CACHE_TIME'] = 3600;
}


$arParams['IBLOCK_TYPE'] = trim($arParams['IBLOCK_TYPE']);
$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
$arParams['ELEMENT_URL'] = trim($arParams['ELEMENT_URL']);

$arParams['ELEMENT_COUNT'] = intval($arParams['ELEMENT_COUNT']);
if ($arParams['ELEMENT_COUNT'] <= 0) {
    $arParams['ELEMENT_COUNT'] = 10;
}

if ($this->StartResultCache(false, rand(1,4))) {


    $arSelect = array(
        'ID',
        'CODE',
        'IBLOCK_ID',
        'NAME',
        'PREVIEW_PICTURE',
        'DETAIL_PAGE_URL',
        'PREVIEW_TEXT',
        'PREVIEW_TEXT_TYPE',
        'SHOW_COUNTER'
    );

    $arFilter = array(
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'IBLOCK_ACTIVE' => 'Y',
        'ACTIVE' => 'Y',
        'ACTIVE_DATE' => 'Y'
    );
   
    $arSort = array(
        'RAND' => 'ASC',
    );

    $arLimit = array(
        'nTopCount' => $arParams['ELEMENT_COUNT']
    );
    //  Запрос к бд за элементами GetList 
    $rsElements = CIBlockElement::GetList(
        $arSort,
        $arFilter,
        false,
        $arLimit,
        $arSelect
    );


    $rsElements->SetUrlTemplates($arParams['ELEMENT_URL'], '');

    $arResult['ITEMS'] = array();
    while ($arItem = $rsElements->GetNext()) {

        //  SEO-свойства 
        $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(
            $arItem['IBLOCK_ID'],
            $arItem['ID']
        );
        $arItem['IPROPERTY_VALUES'] = $ipropValues->getValues();

        $arItem['PREVIEW_PICTURE'] =
            (0 < $arItem['PREVIEW_PICTURE'] ? CFile::GetFileArray($arItem['PREVIEW_PICTURE']) : false);
        if ($arItem['PREVIEW_PICTURE']) {
            $arItem['PREVIEW_PICTURE']['ALT'] =
                $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT'];
            if ($arItem['PREVIEW_PICTURE']['ALT'] == '') {
                $arItem['PREVIEW_PICTURE']['ALT'] = $arItem['NAME'];
            }
            $arItem['PREVIEW_PICTURE']['TITLE'] =
                $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'];
            if ($arItem['PREVIEW_PICTURE']['TITLE'] == '') {
                $arItem['PREVIEW_PICTURE']['TITLE'] = $arItem['NAME'];
            }
        }

        $arResult['ITEMS'][] = $arItem;
    }
    
    if (empty($arResult['ITEMS'])) { // false
        $this->AbortResultCache();
    }
    
	/* сам шаблон  */
    $this->IncludeComponentTemplate();

}