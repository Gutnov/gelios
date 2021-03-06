# JS библиотека модуля

В ней будет описываться общий функционал (добавление в корзину, в избранное, возможно авторизация/регистрация и т.д.)

Работает как паттерн "Наблюдатель". По завершении какого то действия рассылает всем подписчикам оповещение о завершении.

## Как подписаться на события:

- В шаблоне компонента создаем файл ```script.js``` и ```result_modifier.php```, если его нет.
- В ```result_modifier.php``` вставляем код:

	```php
	\Odva\Helpers\JsLib::registerExt($this);
	```
	В этот метод можно вторым параметром передать библиотеки, от которых зависит данный файл ```script.js```
	Например, можно передать ```['jquery']``` (*конкретно jquery можно не передавать, потому что сама библиотека odva.lib.js от нее зависит, то есть когда подключится библиотека из вашего шаблона, jquery уже будет доступен*).

- Внутри файла ```script.js``` организовать минимальную структуру

	```js
	var lib = {
		notify: function(event, data)
		{}
	};

	odvaHelpers.subscribe(lib, ['cart:add']);
	```

	где:

	lib - **уникальное** название переменной, так как оно глобальное, пересекаться с другими не должно

	odvaHelpers - общая библиотека модуля

В примере выше мы подписались на событие добавления товара в корзину. После этого, если произойдет событие добавления в корзину, в функцию **notify** нашего объекта **lib** прилетит событие, в котором **event = 'cart:add'**, а в **data** будут данные, которые вернул сервер в ответе ajax-запроса. Далее можно как то обработать html код нашего компонента, например, увеличить количество продуктов в корзине.

