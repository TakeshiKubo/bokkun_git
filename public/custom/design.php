<!-- デザイン用ファイル (PHPで処理を記述)-->
<?php
require_once (FUNCTION_DIR. '/setFunc.php');
require_once (FUNCTION_DIR. '/function.php');
require_once (DOCUMENT_ROOT. '/API/smarty/core.php');
$smarty->assign('name', 'guest');
$smarty->display('index.tpl');
