<?php
namespace PrivateSetting;
require_once AddPath(dirname(__DIR__, 2), AddPath('common', 'Setting.php', false), false);
function GetSelf_Admin() {
    return filter_input_fix(INPUT_SERVER, 'PHP_SELF');
}

function GetPrevPage_Admin() {
    return filter_input_fix(INPUT_SERVER, 'HTTP_REFERER');
}


function getURI_Admin() {
    return filter_input_fix(INPUT_SERVER, 'REQUEST_URI');
}

class Setting extends \commonSetting\Setting {

    protected $domain, $url, $public;
    protected $client, $css, $js, $image;

    function __construct()
    {
        // 基本設定(親クラスのコンストラクタにアクセス)
        parent::__construct();

        // 基本設定
        $this->private = AddPath('', 'private');
        $this->client = AddPath($this->private, 'client', true, '/');


        // 公開パス関係
        $this->css = AddPath($this->client, 'css', false, '/');
        $this->js = AddPath($this->client, 'js', false, '/');
        $this->image = AddPath($this->client, 'image', false, '/');
        $this->csv = AddPath($this->client, 'csv', false, '/');
        $this->filepageImage = AddPath($this->public, 'image', false, '/');
    }
    
    // URLのドメインを取得
    public static function GetDomain() {
        return parent::GetSERVER('HTTP_HOST');
    }

    // IPアドレスを取得
    public static function GetHostIp($hostName = null) {
        if (is_null($hostName)) {
            $ret = parent::GetSERVER('REMOTE_ADDR');
        } else {
            $ret = gethostbyname($hostName);
        }
        return $ret;
    }

    // IPアドレスからホスト名を取得
    public static function GetHostName($ipName = null) {
        if (is_null($ipName)) {
            $ipName = self::GetHostIp();
        }

        return gethostbyaddr($ipName);
    }

}

class Admin extends Setting {
    function __construct()
    {
    }

    public static function GetSelf()
    {
        return parent::GetSERVER('PHP_SELF');
    }

    public static function GetPrevPage()
    {
        return parent::GetSERVER('HTTP_REFERER');
    }


    public static function getURI()
    {
        return filter_input_fix(INPUT_SERVER, 'PHP_SELF');
    }
}

$commonPath = AddPath(dirname(__DIR__, 2), basename(__DIR__));

require_once(AddPath($commonPath, 'Setting.php', false));

// セッションクラス (公開側)
class Session extends \CommonSetting\Session
{
}

// クッキークラス (公開側)
class Cookie extends \CommonSetting\Cookie
{
}

$domain = filter_input_fix(INPUT_SERVER, 'SERVER_NAME');

$url = $http.$domain;
$private = $url. '/private/';

// 定数などの定義
$agent = filter_input_fix(INPUT_SERVER, 'HTTP_USER_AGENT');
$referer = filter_input_fix(INPUT_SERVER, 'HTTP_REFERER');

$public = $url . '/public/';

// 公開ファイル関係
$client = $public . 'client/';
$image = $client . 'image';

define('IMAGE_URL', $image);

