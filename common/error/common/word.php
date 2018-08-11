<?php
    $ret = array();
    $ret['headerTitle'] = $title;
    switch ($errCode) {
        case '400':
            $ret['title'] = 'Bad Request';
            $ret['message'] = 'リクエストが不正です。';
            break;
        case '401':
            $ret['title'] = 'Unauthorized';
            $ret['message'] = '本サイトの閲覧には認証が必要です。';
            break;
        case '404':
            $ret['title'] = 'NotFound';
            $ret['message'] = 'ページが見つかりません。';
            break;
        case '403':
            $ret['title'] = 'Forbidden';
            $ret['message'] = 'アクセスが許可されていません。';
            break;
        case '500':
            $ret['title'] = 'InternalServerError';
            $ret['message'] = 'サーバ内部でエラーが発生しました。管理者までご連絡お願いします。';
            break;
        default:
            $ret['title'] = 'Other Error';
            $ret['message'] = 'エラーが発生しました。管理者までご連絡お願いします。';
            break;
    }

    $title = $ret;
