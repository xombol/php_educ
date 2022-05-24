<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
?>


<section class="page-main__product product js-slider-wrapper">
	<h2 class="product__title">Популярные товары<sup>&nbsp;20</sup></h2>
 <a class="product__more" href="">Смотреть все товары</a> <button aria-label="Назад" class="product__slide-button--prev product__slide-button js-product-swiper-button-prev button--light"> </button>
	<div class="swiper-container">
		<ul class="product__list swiper-wrapper">
		
		
		
<?


foreach($arResult['ITEMS'] as $item) {
?>

	
		
		
			<li class="product__item swiper-slide">
				<div class="product__menu">
					<p class="product__code">
						Код: 123456
					</p>
					<a class="product__comparison menu-button" href="<?= $item["DETAIL_PAGE_URL"] ?>"> <span class="visually-hidden">Сравнить товар</span> </a> <a class="product__favorite menu-button" href=""> <span class="visually-hidden">Добавить в избранное</span> </a>
				</div>
				<div class="product__img-wrapper">
					<div class="product__offers-wrapper">
					<? if($item["PROPS"]["NEW"]) {?>
						<span class="product__offers product__offers--new">Новинка</span>
					<? } ?>
					<? if($item["PROPS"]["HIT"]) {?>
						<span class="product__offers product__offers--hit">Хит</span>
					<? } ?>

					

					</div>
					<a href="<?= $item["DETAIL_PAGE_URL"] ?>"> <span> <source srcset="<?= CFile::GetPath($item["PREVIEW_PICTURE"]) ?>" type="image/webp"> 
					<img width="270" src="<?= CFile::GetPath($item["PREVIEW_PICTURE"]) ?>" height="250" class="product__img" srcset="<?= CFile::GetPath($item["PREVIEW_PICTURE"]) ?>" alt=""> 
					</span> 
					</a>
				</div>
				<h3><a class="product__name" href="<?= $item["DETAIL_PAGE_URL"] ?>"><?= $item["NAME"] ?></a></h3>
				<? if ($item["NAME"] == 'В наличии') { ?>
				<p class="product__availability product__availability--in-stock">
					В наличии
				</p>
				<?} else {?>
				<p class="product__availability product__availability--out-stock">
					Под заказ
				</p>
				<? }?>
				<div class="product__price-wrapper">
					<div class="product__price-sub-wrapper">
						<p class="product__price">
							 Цена за м2 <?= CurrencyFormat($item["PRICE"], $item["CURRENCY"]); ?>
						</p>
						<p class="product__price product__price--module">
							 Цена за модуль <?= CurrencyFormat($item["PRICE"] * 10, $item["CURRENCY"]); ?>
						</p>
					</div>
					<div class="product__number number">
					<button class="number__button js-number__button--inc button button--light" value="-" aria-label="Убавить" type="button"> </button> <label class="number__label"> <input class="number__input" min="1" value="1" type="number" readonly="">
						м2 </label> <button aria-label="Прибавить" class="number__button js-number__button--dec button button--light" value="+" type="button"> </button>
					</div>
				</div>
				<a class="product__button button button--blue" href="<?= $item["DETAIL_PAGE_URL"] ?>">
				В&nbsp;корзину </a> 
			</li>
			
			
			
			
<?
}
?>				
			
			</ul>
	</div>
 <button aria-label="Вперед" class="product__slide-button--next product__slide-button js-product-swiper-button-next button--light"> </button>
	<div class="product__slider-button-wrapper js-button-wrapper">
 <button aria-label="Назад" class="product__slide-button--prev product__slide-button js-product-swiper-button-prev button--light"> </button> <button aria-label="Вперед" class="product__slide-button--next product__slide-button js-product-swiper-button-next button--light"> </button>
	</div>
 </section>

<!--Распечатаем массив   -->
