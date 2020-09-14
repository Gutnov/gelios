<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
include 'sms.ru.php';

$number = trim($_POST['PHONE']);
$code = rand(1000,9999);
$md5 = md5($code);


$smsru = new SMSRU(SMS_API_KEY);

$data = new stdClass();
$data->to = $number;
$data->text = strval($code);
$sms = $smsru->send_one($data);

if ($sms->status == "OK")
{
	echo json_encode(
		[
			'code' => $md5,
			'success' => true,
		]
	);
}
else
{
	echo json_encode(
		[
			'success' => false,
			'errorCode' => $sms->status_code,
			'errorMsg' => $sms->status_text
		]
	);
}