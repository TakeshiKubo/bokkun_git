<!-- デザイン用ファイル (PHPで処理を記述)-->
<?php

use BasicTag\ScriptClass;

$posts = PublicSetting\Setting::GetPosts();
$session = new PublicSetting\Session();

if (isset($posts['csv']) && $posts['csv'] === 'make') {
    $alert = new ScriptClass();

    if (isset($posts['send'])) {
        $alert->Alert('CSVを作成します。');
        $inputFlg = true;
    } else if (isset($posts['view'])) {
        $inputFlg = false;
    }

    Main($inputFlg);
}
?>
<div class='product-csv'>
    <form method='POST'>
        <table>
            <caption>
                <h2>CSV作成／データ追加・変更</h2>
            </caption>
            <thead>
                <tr>
                    <th>
                        ファイル名
                    </th>
                    <td>
                        <input type='text' name='file-name' />
                    </td>

                    <th>
                        列番号
                    </th>
                    <td>
                        <input type='text' name='col-number' />
                    </td>
                </tr>
                <tr>
                    <th>要素x</th>
                    <th>要素y</th>
                    <th>要素z</th>
                </tr>
            </thead>
            <tbody>
                <td>
                    <input type='text' name='x-value' />
                </td>
                <td>
                    <input type='text' name='y-value' />
                </td>
                <td>
                    <input type='text' name='z-value' />
                </td>
            </tbody>
        </table>
        <input type='hidden' name='csv' value="make" />
        <input type='hidden' name='token' value="<?= $token = MakeToken() ?>" />
        <button type='submit' name='send' value='true'>データを送信</button>
        <button type='submit' name='view' value='true'>データを表示</button>
    </form>
    <?php
    $csvData = $session->Read('csv');
    if (empty($csvData)) {
        $csvData['header'] = null;
        $csvData['row'] = null;
    }
    ?>
    <div name='output'>
        <h2>CSV表示</h2>
        <span class='header'><?= $csvData['header'] ?></span> <br />
        <span class='row'><?= $csvData['row'] ?></span>
    </div>

    <?php
    $filePath = AddPath(PUBLIC_CSV_DIR, basename(__DIR__));

    // ディレクトリが存在しない場合は作成
    if (!is_dir($filePath)) {
        mkdir($filePath, 0775, true);
    }

    $fileArray = IncludeFiles($filePath, 'csv', true);
    $base = new PublicSetting\Setting();

    // 次期改修
    //$downloadHtml = new CustomTagCreate();
    //$downloadHtml->SetHref('test', 'download', 'csv', false, "download");
    //$downloadHtml->ExecTag(true);

    foreach ($fileArray as $_value) {
        $_filePath = AddPath($base->GetUrl(basename(__DIR__), 'csv'), $_value, false);
        echo "<a href=\"{$_filePath}\" download>{$_value}ダウンロード</a><br/>";
    }
    ?>
    <base href='../' />
    <div class='product-webgl'>
        <script src="public/client/js/<?= basename(PUBLIC_COMMON_DIR) ?>/WebGLProgram/shader.js"></script>
        <script src="public/client/js/<?= basename(PUBLIC_COMMON_DIR) ?>/WebGLProgram/ProgramObject.js"></script>
        <script src="public/client/js/<?= basename(PUBLIC_COMMON_DIR) ?>/WebGLProgram/BufferObject.js"></script>
        <script src="public/client/js/<?= basename(PUBLIC_COMMON_DIR) ?>/WebGLProgram/VBO.js"></script>
        <script src="public/client/js/<?= basename(PUBLIC_COMMON_DIR) ?>/WebGLProgram/IBO.js"></script>
        <script src="public/client/js/<?= basename(PUBLIC_COMMON_DIR) ?>/WebGLProgram/texture.js"></script>
        <script src="public/client/js/<?= basename(PUBLIC_COMMON_DIR) ?>/WebGLProgram/minMatrix.js"></script>


        <script id='vshader' type='x-shader/x-vertex'>
            /* 頂点シェーダ  */
        attribute vec3 position;
        attribute vec4 color;
        uniform mat4 mvpMatrix;
        varying vec4 vColor;
        void main(void) {
        gl_Position = mvpMatrix * vec4(position, 1.0);
        vColor = color;
        }

    </script>
        <script id="fshader" type='x-shader/x-fragment'>
            /* フラグメントシェーダ  */
        precision mediump float;
        varying vec4 vColor;
        void main(void) {
        gl_FragColor = vColor;
        }
    </script>

        <canvas id="canvas" width=30 height=30>
            このブラウザは、webGLに対応していません。
        </canvas>

        <form>
            R <input type="range" name="color" min="0" max="255" value="0" />
            G <input type="range" name="color" min="0" max="255" value="0" />
            B <input type="range" name="color" min="0" max="255" value="0" />
            A <input type="range" name="color" min="0" max="1.0" step="0.01" value="1.0" />

            <button type="button" name="redraw" onclick="console.clear(); main();">再描画</button>
        </form>
        <contents>
            色付きの三角形ポリゴンを表示する。
            色はバーで選択できる。
        </contents>
    </div>
    <?php
    SetToken($token);
