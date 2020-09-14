<?php
$arUrlRewrite = [
	[
		'CONDITION' => '#^/catalog/(.*)/sort/(.*)/filter/(.*)/apply/#',
		'RULE'      => 'section=$1&sort=$2&filter=$3&cath=$4',
		'PATH'      => '/catalog/index.php',
	],
	[
		'CONDITION' => '#^/catalog/(.*)/filter/(.*)/apply/sort/(.*)/#',
		'RULE'      => 'section=$1&filter=$2&sort=$3&cath=$4',
		'PATH'      => '/catalog/index.php',
	],
	[
		'CONDITION' => '#^/catalog/(.*)/filter/(.*)/apply/#',
		'RULE'      => 'section=$1&filter=$2&cath=$3',
		'PATH'      => '/catalog/index.php',
	],
	[
		'CONDITION' => '#^/catalog/(.*)/sort/(.*)/#',
		'RULE'      => 'section=$1&sort=$2&cath=$3',
		'PATH'      => '/catalog/index.php',
	],
	[
		'CONDITION' => '#^/catalog/(.*)/nav/(.*)/#',
		'RULE'      => 'section=$1&cath=$2',
		'PATH'      => '/catalog/index.php',
	],
	[
		'CONDITION' => '#^/catalog/(.*)/(.*)/#',
		'RULE'      => 'mode=read&section_code=$1&product_code=$2&cath=$3',
		'PATH'      => '/catalog/detail.php',
	],
	[
		'CONDITION' => '#^/catalog/(.*)/#',
		'RULE'      => 'section=$1&cath=$2',
		'PATH'      => '/catalog/index.php',
	],
	[
		'CONDITION' => '#^/personal/orders/([0-9]+)#',
		'RULE'      => 'oid=$1',
		'PATH'      => "/personal/orders/detail.php",
	],
	[
		'CONDITION' => '#^/cart/order/([0-9]+)#',
		'RULE'      => 'id=$1',
		'PATH'      => "/cart/order/detail.php",
	]
];
