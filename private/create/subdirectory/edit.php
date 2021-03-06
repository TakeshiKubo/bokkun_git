<!DOCTYPE html>
<?php
define("DS", DIRECTORY_SEPARATOR);

// 関数定義 (初期処理用)
require dirname(__DIR__, 2) . DS . 'common' . DS . 'InitFunction.php';
// 設定
require_once dirname(__DIR__, 2) . DS . "common" . DS . "Setting.php";
// タグ
require_once dirname(__DIR__, 2) . DS . AddPath("common", "Component") . DS . "Tag.php";
// 定数・固定文言など
require_once AddPath(AddPath(AddPath(dirname(__DIR__, 2), "common", false), "Word", false), "Message.php", false);
// CSRF
require_once PRIVATE_COMMON_DIR . "/Token.php";

define("MAX_LENGTH", 32);

$adminError = new AdminError();
$use = new \PrivateTag\UseClass();

// tokenチェック
$checkToken = CheckToken();

// 不正tokenの場合は、エラーを出力して処理を中断。
if ($checkToken === false) {
    $sessClass =  new PrivateSetting\Session();
    $sessClass->Write('notice', '<span class="warning">不正な遷移です。もう一度操作してください。</span>', 'Delete');
    $url = new PrivateSetting\Setting();
    $backUrl = CreateClient('private', dirname(__DIR__));
    $backUrl = ltrim($backUrl, DS);
    header('Location:' . $url->GetUrl($backUrl));
    exit;
}

$adminPath = dirname(__DIR__);
$basePath = dirname(dirname(dirname(__DIR__)));

$session = $_SESSION;
$post = $_POST;
$judge = array();
foreach ($post as $post_key => $post_value) {
    $$post_key = $post_value;
    $judge[$$post_key] = $post_value;
}

$pathList = ['php'];
$subPathList = scandir(AddPath(AddPath($basePath, 'public'), 'client'));
foreach ($subPathList as $_key => $_val) {
    if (!FindFileName($_val)) {
        unset($subPathList[$_key]);
    }
}
$pathList = array_merge($pathList, $subPathList);

if ((isset($edit) || isset($copy)) && empty($delete)) {
    // 編集モード
    if (empty($title)) {
        if (!isset($session['addition'])) {
            $session['addition'] = $post;
            $_SESSION = $session;
        }
        unset($session);
        unset($post);
        $adminError->UserError('未記入の項目があります。');
    } else {
        // ファイル存在チェック
        foreach ($pathList as $_pathList) {
            $client = $basePath . '/public/';
            if ($_pathList === 'php') {
                $client = $basePath;
            } else {
                $client .= "client/".
                $_pathList. "/";
            }
                foreach (scandir($client) as $file) {
                if (mb_strpos($file, '.') !== 0) {
                    if (isset($edit) && !isset($delete)) {
                        if ($file === $title) {
                            $adminError->UserError("ご指定のタイトルのファイルは既に存在します。ページの編集を中止します。");
                        }
                    }
                }
            }
        }
    }
    if (preg_match('/^[a-zA-Z][a-zA-Z0-9-_+]*$/', $title) === 0) {
        $adminError->UserError('タイトルに無効な文字が入力されています。');
    } else if (strlen($title) > MAX_LENGTH) {
        $adminError->UserError("タイトルの文字数は、" . MAX_LENGTH . "文字以下にしてください。");
    }
} else if (empty($delete)) {
    // その他（不正値）
    if (!isset($session['addition'])) {
        $session['addition'] = $post;
        $_SESSION = $session;
    }
    unset($session);
    unset($post);
    $adminError->UserError('不正な値が入力されました。');
}

chdir($basePath);
foreach ($pathList as $_pathList) {
    if ($_pathList === 'php') {
            // 入力値のチェック
            if (!isset($select)) {
                $select = null;
            }
            $validate = ValidateData(getcwd(), $select);
            if ($validate === null) {
                $adminError->UserError('ページが選択されていません。');
            } else if ($validate === false) {
                $adminError->UserError('ページの指定が不正です。');
            }
        if (isset($delete)) {
            // 削除モード
            DeleteData(AddPath(getcwd(), $select));
        } else if (isset($copy)) {
            // 複製モード
            CopyData(AddPath(getcwd(), $select), $title);
        } else if (isset($edit)) {
            // 編集モード
        } else {
            // どちらでもない
            $adminError->UserError("不正な遷移です。");
        }
    } else {
        if (!strpos(getcwd(), 'client')) {
            $client = "public/client/";
            $adminPath .= '/' . $client;
        } else {
            $client = "../";
        }
        chdir("{$client}{$_pathList}");               // パスの移動
        if (isset($delete)) {
            // 削除モード
            DeleteData(AddPath(getcwd(), $select));
        } else if (isset($copy)) {
            // 複製モード
            if (is_dir(AddPath(getcwd(), $select))) {
                CopyData(AddPath(getcwd(), $select), $title);
            }
        } else if (isset($edit)) {
            // 編集モード
        } else {
            // どちらでもない
            $adminError->UserError("不正な遷移です。");
        }
    }
}

if (isset($edit)) {
    $use->Alert("{$select}ページを編集しました。");
} else if (isset($copy)) {
    $use->Alert("{$select}ページを複製しました。");
} else if (isset($delete)) {
    $use->Alert("{$select}ページを削除しました。");
}

class AdminError
{
    protected $use;
    public function __construct()
    {
        $this->use = new \PrivateTag\UseClass();
    }

    public function UserError($message, $exit_flg=true)
    {
        $this->use->Alert($message);
        $this->use->BackAdmin('create');
        if ($exit_flg === true) {
            exit;
        }
    }

    public function Alert($message)
    {
        $this->use->Alert($message);
    }

    public function Confirm($message)
    {
        $this->use->Confirm($message);
    }
    public function Maintenance()
    {
        $this->UserError('メンテナンス中です。しばらくお待ちください。');
    }
}
?>

<head>
    <base href="../" />
</head>
<script>
    onload = function() {
        title = document.getElementsByName('title')[0].value;
        if (title) {
            title = location.protocol + '//' + location.host + '/' + title;
            open(title);
        }

        location.href = "./";
    }
</script>

<body>
    <input type="hidden" name="title" value="<?php echo $title; ?>" />
</body>