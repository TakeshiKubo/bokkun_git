<?php
// エラーログの設定(初期設定)
$errLogArray = [];
$errLogArray['errLogBasePath'] = AddPath(dirname(__DIR__, 3), AddPath("log", "error"), false);
$errLogArray['errLogPath'] = AddPath($errLogArray['errLogBasePath'],  phpversion());
if (!is_dir($errLogArray['errLogPath'])) {
    mkdir($errLogArray['errLogPath']);
    mkdir(AddPath($errLogArray['errLogPath'], '_old'));
}
ini_set("error_log", AddPath($errLogArray['errLogPath'], "php_error.log", false));
unset($errLogArray);

require_once AddPath('mode', 'remote.php', false);

// エラーハンドラ設定
set_error_handler(function ($error_no, $error_msg, $error_file, $error_line) {
    if (error_reporting() === 0) {
        return;
    }
    throw new ErrorException($error_msg, 0, $error_no, $error_file, $error_line);
});

// set_exception_handler(function($throwable) {
//     $development = true;
//     // 開発環境ならエラーログを標準出力出すようにしてしまったほうが使い勝手がよさそうです（なくてもいい）
//     if (isset($development) && $development === true) {
//         echo $throwable;
//     }
//     send_error_log($throwable);
// });


register_shutdown_function(function() {
    $error = error_get_last();
    if ($error === null) {
        return;
    }

    // fatal error の場合はすでに何らかの出力がされているはずなので、何もしない

    if (php_sapi_name() !== 'cli') {
        $cnf = new Header();
        $errScript = new BasicTag\ScriptClass();

        $errScript->Alert("エラーが発生しました。");
        if (strcmp($cnf->GetVersion(), '-local') === 0 || strcmp($cnf->GetVersion(), '-dev') === 0) {
            $errMessage = str_replace('\\', '/', $error['message']);
            $errMessage = str_replace(array("\r\n", "\r", "\n"), '\\n', $errMessage);
            $errMessage = str_replace("'", "\'", $errMessage);
            if (strcmp($cnf->GetVersion(), '-local') === 0) {
                $errFile = str_replace('\\', '/', $error['file']);
                $errFile = str_replace('\n', '\\n', $errFile);
                $errScript->Alert($errMessage. "\\n\\n".
                    "file: ". $errFile . "\\n".
                    "line: ". $error['line']);
            } else {
                $errScript->Alert($errMessage);
            }
        }
    }
});


function send_error_log($throwable) {
    // 何かエラーをどこかに渡すコードをここに。
    // この例ではテンポラリファイルディレクトリを取得してそこに php_error_log.txt という名前のファイルに追記していくような処理にした。
    file_put_contents(sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php_error_log.txt', $throwable->__toString(), FILE_APPEND | LOCK_EX);
}
// 既存のパスに新たな要素を追加する
function AddPath($local, $addpath, $lastSeparator=true,  $separator=DIRECTORY_SEPARATOR) {
    if (mb_substr($local, -1) == $separator) {
        $first = '';
    } else {
        $first = $separator;
    }
    if ($lastSeparator == true) {
        $last = $separator;
    } else {
        $last = '';
    }

    $local .= $first. $addpath. $last;    // パス追加 + パス結合

    $local = htmlspecialchars($local);    // XSS対策

    return $local;
}

// ヌルバイト対策 (POST, GET)
function Sanitize($arr) {
    if (!is_string($arr)) {
        return $arr;
    }

    if (is_array($arr) ){
        return array_map('Sanitize', $arr);
    }
    return str_replace("\0", "", $arr);     //ヌルバイトの除去
}

/**
 * CreateClient
 * 所定のディレクトリまでのディレクトリ群を走査し、パスを生成する。
 *
 * @param  string $target
 *
 * @return bool
 */
function CreateClient($target, $src = '')
{
  if (empty($src)) {
    $srcPath = getcwd();
  } else {
    $srcPath = $src;
  }

  $clientPath = "";
  $clientAry = [];

  if ($srcPath !== dirname($srcPath)) {
    while (1) {
        $clientAry[] = basename($srcPath);
        $srcPath = dirname($srcPath);
        if (strcmp(basename($srcPath), $target)) {
            break;
        }
     }
} else {
    $clientAry[] = $target;
}

  $clientAry = array_reverse($clientAry);

  foreach ($clientAry as $_client) {
    $clientPath = AddPath($clientPath, $_client);
  }

  return $clientPath;
}
/**
 * CheckToken
 * Post値とセッション値のチェック
 *
 *
 * @param  string $tokenName
 * @param  boolean $chkFlg
 *
 * @return bool
 */
function CheckSession($SessionName, $chkFlg)
{
    $input = CommonSetting\Setting::GetPost($SessionName);
    $session = new CommonSetting\Session();

    if ($chkFlg === true) {
        echo 'デバッグ用<br/>';
        echo 'post: ' . $input . '<br/>';
        echo 'session: ' . $session->Read($SessionName) . '<br/><br/>';
    }

    if (is_null($input) || $input === false || is_null($session->Read($SessionName)) || !hash_equals($session->Read($SessionName), $input)) {
        return false;
    }

    return true;
}

/**
 * filter_input_fix
 * $_SERVER, $_ENVのための、filter_input代替処理。
 *
 *
 * @param  mixed $type
 * @param  mixed $variable_name
 * @param  int $filter
 * @param  mixed|null $options
 *
 * @return bool
 */
function filter_input_fix($type, $variable_name, $filter = FILTER_DEFAULT, $options = NULL )
{
    $checkTypes =[
        INPUT_GET,
        INPUT_POST,
        INPUT_COOKIE
    ];

    if ($options === NULL) {
        // No idea if this should be here or not
        // Maybe someone could let me know if this should be removed?
        $options = FILTER_NULL_ON_FAILURE;
    }

    if (in_array($type, $checkTypes) || filter_has_var($type, $variable_name)) {
        $ret = filter_input($type, $variable_name, $filter, $options);
    } else if ($type == INPUT_SERVER && isset($_SERVER[$variable_name])) {
        $ret = filter_var($_SERVER[$variable_name], $filter, $options);
    } else if ($type == INPUT_ENV && isset($_ENV[$variable_name])) {
        $ret = filter_var($_ENV[$variable_name], $filter, $options);
    } else {
        $ret = NULL;
    }

    return $ret;
}

/**
 * MoldData
 *
 *
 */
function MoldData($data, $parameter = ',') {
    $ret = false;
    if (is_null($data)) {
        return false;
    }

    if (is_array($data)) {
        $ret = implode($parameter, $data);
    } else if (is_string($data)) {
        $ret = explode($parameter, $data);
    }

    return $ret;
}
/**
 * Output
 *
 * @param [mixed] $expression
 * @param boolean $formatFlg
 * @param boolean $indentFlg
 * @param array $debug
 * @return void
 */
function Output($expression, $formatFlg = false, $indentFlg = true, array $debug = [])
{
    if ($formatFlg === true) {
        print_r("<pre>");
        print_r($expression);
        print_r("</pre>");
    } else {
        print_r($expression);
        if ($indentFlg === true) {
            print_r(nl2br("\n"));
        }
    }

    $debugMessage = DEBUG_MESSAGE_SOURCE;
    if (!empty($debug)) {
        $debugTrace = debug_backtrace();
        $debugValidate = DebugValidate($debug, $debugTrace);
        if (!empty($debugValidate)) {
            $errScript = new BasicTag\ScriptClass();
            foreach ($debugValidate as $_DEBUG_KEY) {
                if ($debugMessage[$_DEBUG_KEY]) {
                    $errScript->Alert($debugMessage[$_DEBUG_KEY]);
                }
            }
            return -1;
        }

        $layer = $debug['layer'] - 1;

        if (isset($debug['mode'])) {
            switch ($debug['mode']) {
                case 'source':
                    echo "<pre>source: " . $debugTrace[$layer]['file'] . "</pre>";
                    break;
                case 'line':
                    echo "<pre>line: " . $debugTrace[$layer]['line'] . "</pre>";
                    break;
                case 'function':
                    echo "<pre>function: " . $debugTrace[$layer]['function'] . "</pre>";
                    break;
                default:
                    echo "<pre>source: " . $debugTrace[$layer]['file'] . "</pre>";
                    echo "<pre>line: " . $debugTrace[$layer]['line'] . "</pre>";
                    echo "<pre>function: " . $debugTrace[$layer]['function'] . "</pre>";
                    break;
            }
        }
    }
}

function DebugValidate(array $debug, array $debugTrace) {
    $validate = [];

    if (!isset($debug['layer']) || !isset($debug['mode'])) {
        $validate[] = "ERR_DEBUG_COND";
        return $validate;
    }

    if (!is_string($debug['mode'])) {
        $validate[] = "SETTING_DEBUG_TRACE";
    }

    if ($debug['layer'] - 1 < 0) {
        $validate[] = "ERR_DEBUG_FEW_TRACE_LAYER";
    }

    if ($debug['layer'] - 1 > count($debugTrace)) {
        $validate[] = "ERR_DEBUG_TOO_TRACE_LAYER";
    }

    return $validate;
}

function SetPlugin($name) {
    if (is_array($name)) {
        foreach ($name as $_dir) {
            SetPlugin($_dir);
        }
        return FINISH;
    }

    if (is_dir(AddPath(PLUGIN, $name))) {
        IncludeDirctories(AddPath(PLUGIN, $name));
    }
}

function SetAllPlugin() {
    $addDir = scandir(PLUGIN);

    foreach ($addDir as $_key => $_dir) {
        if (strpos($_dir, '.') !== false || strpos($_dir, '..')  !== false) {
            unset($addDir[$_key]);
        }
    }

    SetPlugin($addDir);
}
