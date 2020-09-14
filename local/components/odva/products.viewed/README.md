# Компонент для отображения просмотренных товаров

Достает список методом *\Bitrix\Catalog\CatalogViewedProductTable::getList*
Поэтому ID инфоблока не требуется.

Подключение компонента стандартное:

```php
$APPLICATION->IncludeComponent('odva:products.viewed', '', []);
```

Возможные параметры для передачи в компонент:
- COUNT - количество выводимых элементов, по умолчанию 10

*Если компонент детальной страницы самодельный, то при просмотре продукта надо обновлять историю его просмотров. Делается это так*
```php
// https://dev.1c-bitrix.ru/api_d7/bitrix/catalog/catalogviewedproducttable/refresh.php

\Bitrix\Catalog\CatalogViewedProductTable::refresh(
	$productId,
 	CSaleBasket::GetBasketUserID()
);
```
