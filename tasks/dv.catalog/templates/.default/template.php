<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
?>

<section id="iblock-items">
<?php foreach ($arResult['ITEMS'] as $arItem):?>
    <article>
        <a href="<?= $arItem['DETAIL_PAGE_URL']; ?>"></a>
        <h4><a href="<?= $arItem['DETAIL_PAGE_URL']; ?>"><?= $arItem['NAME']; ?></a></h4>
    </article>
<?php endforeach; ?>
</section>
<!--Распечатаем массив   -->
<pre>
<? print_r( $arItem); ?>
</pre>