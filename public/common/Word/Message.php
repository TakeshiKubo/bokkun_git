<?php

use CommonSetting\Setting;

$commonWordPath = dirname(dirname(dirname(__DIR__)));
$commonWordPath = AddPath($commonWordPath, 'common');
$commonWordPath = AddPath($commonWordPath, 'Word');
$commonWordPath = AddPath($commonWordPath, 'Message.php', false);
require_once $commonWordPath;
// CSRFクラス
function Public_CSRFErrorMessage() {
    $addr = PublicSetting\Setting::GetRemoteADDR();
    $errMessage = "<p><strong>". gethostbyaddr($addr). "(". $addr. ")". "様のアクセスは禁止されています。</strong></p><p>以下の要因が考えられます。</p>";
    $errList = ["指定回数以上アクセスした。", "直接アクセスした。", "不正アクセスした。"];
    $errMessage .='<ul>';
    $errLists = '';
    foreach ($errList as $_errList) {
        $errLists .= "<li>{$_errList}</li>";
    }
    $errMessage .= $errLists;
    $errMessage .='</ul>';

    return $errMessage;
}

// 共通部分
define('PUBLIC_DIR', DOCUMENT_ROOT . '/public');
define('PUBLIC_COMMON_DIR', PUBLIC_DIR. '/common');
define('PUBLIC_CLIENT_DIR', PUBLIC_DIR . '/client');
define('PUBLIC_CSS_DIR', PUBLIC_CLIENT_DIR . '/css');
define('PUBLIC_JS_DIR', PUBLIC_CLIENT_DIR . '/js');
define('PUBLIC_IMAGE_DIR', PUBLIC_CLIENT_DIR . '/image');
define('PUBLIC_CSV_DIR', PUBLIC_CLIENT_DIR . '/csv');
define('PUBLIC_COMPONENT_DIR', PUBLIC_COMMON_DIR . '/Component');
define('PUBLIC_LAYOUT_DIR', PUBLIC_COMMON_DIR . '/Layout');
// デフォルトの可視フラグ
define('DEFAULT_VIEW', VIEW);
