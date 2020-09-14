<?php

\Bitrix\Main\Loader::includeModule('odva.helpers');

function custom_mail($to, $subject, $message, $additionalHeaders = '')
{
	if(!defined('SENDGRID_API_KEY'))
		return false;

	$subject           = iconv_mime_decode($subject);
	$additionalHeaders = iconv_mime_decode_headers($additionalHeaders);

	if(empty($additionalHeaders['From']))
		return false;

	$params = [
		'to'        => $to,
		'from'      => $additionalHeaders['From'],
		'subject'   => $subject,
		'html'      => nl2br($message)
	];

	unset($additionalHeaders['From']);
	unset($additionalHeaders['Content-Type']);

	$headers = ['Authorization: Bearer ' . SENDGRID_API_KEY];
	foreach ($additionalHeaders as $headerName => $headerValue)
		$headers[] = "{$headerName}: {$headerValue}";

	$session = curl_init('https://api.sendgrid.com/api/mail.send.json');

	curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
	curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($session, CURLOPT_POST, true);
	curl_setopt($session, CURLOPT_POSTFIELDS, $params);
	curl_setopt($session, CURLOPT_HEADER, false);
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($session);
	curl_close($session);

	try
	{
		$response = json_decode($response);
	}
	catch(Exception $e)
	{
		return false;
	}

	return $response->message == 'success';
}

//переиндексация для search.title

// регистрируем обработчик
AddEventHandler("search", "BeforeIndex", "BeforeIndexHandler");
// создаем обработчик события "BeforeIndex"
function BeforeIndexHandler($arFields)
{
	if(!CModule::IncludeModule("iblock")) // подключаем модуль
		return $arFields;
	if($arFields["MODULE_ID"] == "iblock")
	{
		$db_props = CIBlockElement::GetProperty(
									$arFields["PARAM2"],         // BLOCK_ID индексируемого свойства
									$arFields["ITEM_ID"],          // ID индексируемого свойства
									array("sort" => "asc"),       // Сортировка
									Array("CODE"=>"INDICATIONS")); // CODE свойства
		if($ar_props = $db_props->Fetch())
			$arFields["TITLE"] .= " ".$ar_props['VALUE']['TEXT'];   // Добавим свойство в конец заголовка индексируемого элемента
   }
   return $arFields; // вернём изменения
}