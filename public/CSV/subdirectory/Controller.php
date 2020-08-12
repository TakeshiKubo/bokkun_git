<?php
require_once PUBLIC_COMMON_DIR. '/Token.php';
IncludeDirctories();
$token = PublicSetting\Setting::GetPost('token');

Main();

function Main($inputFlg=false) {
    $csv = new CSV();

    if ($inputFlg === true) {
        $csv->SetHeader(['x', 'y', 'z']);

        // ファイル名を設定
        $valid = $csv->InputName();
        if ($valid === false) {
            echo "<div class='warning'>ファイル名を入力してください。</div>";
            return false;
        }

        // CSVファイルを取得(編集の場合)
        $valid = $csv->ReadData();
        if ($valid === false) {
            echo "<div class='warning'>列番号の指定が不正です。</div>";
            return false;
        }

        // 入力値を設定
        $valid = $csv->InputData();
        if ($valid === false) {
            return false;
        }

        // CSVファイルを書き込み
        $csv->SetCSV();

    }
}

// CSVオブジェクトを作成
// CSVオブジェクトにデータを挿入
// ファイルに書き出す ←ｲﾏｺｺ

?>
