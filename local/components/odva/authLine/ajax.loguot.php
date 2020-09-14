<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
global $USER;
$USER->Logout();
echo json_encode(['success' =>true, ]);
?>