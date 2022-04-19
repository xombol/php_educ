<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
    'NAME' => 'Элементы из инфоблока', 
    'DESCRIPTION' => 'Выводит данные из инфоблока',
    'ICON' => '/images/icon.gif', 
    'CACHE_PATH' => 'Y', 
    'SORT' => 40, 
    'COMPLEX' => 'N', 
    'PATH' => array( 
        'ID' => 'items_inf', 
        'NAME' => 'Прочие компоненты', 
        'CHILD' => array( 
            'ID' => 'vivod', 
            'NAME' => 'Информационный блок' 
        )
    )
);