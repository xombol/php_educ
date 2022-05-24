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


if ($this->StartResultCache(false)) {


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
		'ID' => $arParams["ELEMENT_ID"], 
        'IBLOCK_ACTIVE' => 'Y',
        'ACTIVE' => 'Y',
        'ACTIVE_DATE' => 'Y'
    );
	/*
echo '<pre>';
print_r($arParams);
	echo '</pre>';
print_r($arResult);
*/


    $arResult = array();

	$arrayProps = array (
	);
	
	$arFilter = Array($arParams['IBLOCK_ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();

		$arResult['ITEMS'][$arFields['ID']] = $arFields;
		
		
		//  Запрос к бд за элементом  
		$rsElements = CIBlockElement::GetProperty(
		$arParams['IBLOCK_ID'],
		 $arFields['ID'],
		 "sort",
		 "asc",
		 $arrayProps
		);


		while ($arItem = $rsElements->GetNext()) {
			$arResult['ITEMS'][$arFields['ID']]['PROPS'][$arItem["CODE"]] = $arItem['VALUE'];
		}
		
	
		$ar_res = CPrice::GetBasePrice($arFields['ID'], false, false);

		$arResult['ITEMS'][$arFields['ID']]["PRICE"] = $ar_res["PRICE"];
		$arResult['ITEMS'][$arFields['ID']]["CURRENCY"] = $ar_res["CURRENCY"];
		
		if($ar_res["PRODUCT_QUANTITY"] >= 1 ) {
			$arResult['ITEMS'][$arFields['ID']]["STATUS"] = "В наличии";
		} else {
			$arResult['ITEMS'][$arFields['ID']]["STATUS"] = "Под заказ";
		}
		
		
	}




    if (empty($arResult)) { // false
        $this->AbortResultCache();
    }
    

    $this->IncludeComponentTemplate();

}