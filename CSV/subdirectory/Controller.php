<?php
IncludeDirctories();

function Main($inputFlg=false) {
    $tokenValid = CheckToken();

    if ($tokenValid === false) {
        echo "<div class='warning'>不正な遷移です。</div>";
        return false;
    }

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
        if ($valid === true) {
            $csv->SetCSV();
        }

    } else {
        // ファイル名を設定
        $valid = $csv->InputName();
        if ($valid === false) {
            echo "<div class='warning'>ファイル名を入力してください。</div>";
            return false;
        }

        // 出力用データ取得
        $header = $csv->Output('header');
        $row = $csv->Output('row');
        $result = $csv->Output();
        if ($result === false) {
            echo "<div class='warning'>ご指定のファイルは存在しません。</div>";
            return false;
        }

        $header = MoldData($header);
        $body = "";
        foreach ($row as $_r) {
            $body .= MoldData($_r). nl2br("\n");
        }
        $session = new PublicSetting\Session();
        $session->WriteArray('csv', 'header', $header);
        $session->WriteArray('csv', 'row', $body);
    }
}

// CSVオブジェクトを作成
// CSVオブジェクトにデータを挿入
// ファイルに書き出す ←ｲﾏｺｺ

?>
