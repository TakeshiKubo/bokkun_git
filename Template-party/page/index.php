<?php
// 必要なファイルの読み込み
$data = scandir(__DIR__);
foreach ($data as $_i => $_d) {
    if (preg_match('/\.$/', $_d) || preg_match('/^\.\.$/', $_d)|| preg_match('/[php]$/', $_d)) {
        unset($data[$_i]);
    }
}

if (empty($data)) {
    $firstPath = dirname(__DIR__, 3);
    $dirPath =  dirname(__DIR__, 2);
    $pagePath = dirname(__DIR__);
} else {
    $firstPath = dirname(__DIR__, 2);
    $dirPath =  dirname(__DIR__);
    $pagePath = __DIR__;
}

require_once $firstPath . '/public/common/Layout/require.php';

// 対象ディレクトリの決定
$dirName = basename($dirPath);
$pageName = basename($pagePath);

// phpのディレクトリ指定
$phpPath = AddPath($dirName, $pageName, false);


// cssのディレクトリ指定
if (is_dir(AddPath(AddPath(PUBLIC_CSS_DIR, $dirName), $pageName))) {
    $cssPath = AddPath($dirName, $pageName, false);
} else {
    $cssPath = $dirName;
}

// jsのディレクトリ指定
if (is_dir(AddPath(AddPath(PUBLIC_JS_DIR, $dirName), $pageName))) {
    $jsPath = AddPath($dirName, $pageName, false);
} else {
    $jsPath = $dirName;
}
// imageのディレクトリ指定
if (is_dir(AddPath(AddPath(PUBLIC_IMAGE_DIR, $dirName), $pageName))) {
    $imagePath = AddPath($dirName, $pageName, false);
} else {
    $imagePath = $dirName;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>個人サイト向け 無料ホームページテンプレート tp_simple16</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="ここにサイト説明を入れます">
<meta name="keywords" content="キーワード１,キーワード２,キーワード３,キーワード４,キーワード５">
<link rel="stylesheet" href="/public/client/css/<?=$cssPath?>/style.css">
<script src="/public/client/js/<?=$jsPath?>/fixmenu_pagetop.js"></script>
<script src="/public/client/js/<?=$jsPath?>/openclose.js"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="home">

<div id="container">

<header>

<h1 id="logo"><a href="/<?=$phpPath?>"><img src="/public/client/image/<?=$imagePath?>/logo.png" alt="SAMPLE SITE"></a></h1>

<!--PC用（801px以上端末）メニュー-->
<nav id="menubar">
<ul>
<li><a href="/<?=$phpPath?>/">Home</a></li>
<li><a href="/<?=$phpPath?>/about/">About</a></li>
<li><a href="/<?=$phpPath?>/gallery/">Gallery</a></li>
<li><a href="/<?=$phpPath?>/link/">Link</a></li>
</ul>
</nav>

<ul class="icon">
<li><a href="#"><img src="/public/client/image/<?=$imagePath?>/icon_facebook.png" alt="Facebook"></a></li>
<li><a href="#"><img src="/public/client/image/<?=$imagePath?>/icon_twitter.png" alt="Twitter"></a></li>
<li><a href="#"><img src="/public/client/image/<?=$imagePath?>/icon_instagram.png" alt="Instagram"></a></li>
</ul>

</header>

<div id="contents">

<aside class="inner first"><img src="/public/client/image/<?=$imagePath?>/mainimg.jpg" alt=""></aside>

<section id="new" class="inner">
<h2>更新情報・お知らせ</h2>
<dl>
<dt>2019/06/10</dt>
<dd>tp_simple16配布開始。<span class="newicon">NEW</span></dd>
<dt>20XX/00/00</dt>
<dd>サンプルテキスト。サンプルテキスト。サンプルテキスト。</dd>
<dt>20XX/00/00</dt>
<dd>サンプルテキスト。サンプルテキスト。サンプルテキスト。</dd>
<dt>20XX/00/00</dt>
<dd>サンプルテキスト。サンプルテキスト。サンプルテキスト。</dd>
<dt>20XX/00/00</dt>
<dd>サンプルテキスト。サンプルテキスト。サンプルテキスト。</dd>
<dt>20XX/00/00</dt>
<dd>サンプルテキスト。サンプルテキスト。サンプルテキスト。</dd>
<dt>20XX/00/00</dt>
<dd>サンプルテキスト。サンプルテキスト。サンプルテキスト。</dd>
</dl>
</section>

<section class="inner">

<h2>テンプレートのご利用前に必ずお読み下さい</h2>

<h3>利用規約のご案内</h3>
<p>このテンプレートは、<a href="https://template-party.com/">Template Party</a>にて無料配布している『個人サイト向け 無料ホームページテンプレート tp_simple16』です。必ずダウンロード先のサイトの<a href="https://template-party.com/read.html">利用規約</a>をご一読の上でご利用下さい。</p>
<p><span class="color1">■<strong>HP最下部の著作表示『Web Design:Template-Party』は無断で削除しないで下さい。</strong></span><br>
わざと見えなく加工する事も禁止です。</p>
<p><span class="color1">■<strong>下部の著作を外したい場合は</strong></span><br>
<a href="https://template-party.com/">Template-Party</a>の<a href="https://template-party.com/member.html">ライセンス契約</a>を行う事でHP下部の著作を外す事ができます。</p>

<h3>テンプレートに梱包されているjavascriptファイル（jsファイル）について</h3>
<p>当テンプレートに梱包されているjavascriptファイルは全て<a href="http://www.crytus.co.jp/">有限会社クリタス様</a>提供のものです。jsファイルは改変せずにご利用下さい。<br>
また、当サイトのテンプレート「以外」に使いたいなど、「プログラムのみ」を使う場合は<a href="http://template-party.com/free_program/openclose_license.html">こちらの規約</a>をお守り下さい。</p>

<h3>当テンプレートの詳しい使い方は</h3>
<p><a href="/<?=$dirName?>/<?=$pageName?>/about/">こちらをご覧下さい。</a></p>

</section>

<footer>
<small>Copyright&copy; <a href="/<?=$phpPath?>">SAMPLE SITE</a> All Rights Reserved.</small>
<span class="pr">《<a href="https://template-party.com/" target="_blank">Web Design:Template-Party</a>》</span>
</footer>

</div>
<!--/#contents-->

</div>
<!--/#container-->

<!--オープニングアニメーション-->
<aside id="mainimg">
<img src="/public/client/image/<?=$imagePath?>/1.png" alt="" class="photo photo1">
<img src="/public/client/image/<?=$imagePath?>/1.png" alt="" class="photo photo2">
<img src="/public/client/image/<?=$imagePath?>/1.png" alt="" class="photo photo3">
<img src="/public/client/image/<?=$imagePath?>/1.png" alt="" class="photo photo4">
<img src="/public/client/image/<?=$imagePath?>/1.png" alt="" class="photo photo5">
<img src="/public/client/image/<?=$imagePath?>/1.png" alt="" class="photo photo6">
<img src="/public/client/image/<?=$imagePath?>/1.png" alt="" class="photo photo7">
<img src="/public/client/image/<?=$imagePath?>/1.png" alt="" class="photo photo8">
<img src="/public/client/image/<?=$imagePath?>/1.png" alt="" class="photo photo9">
</aside>

<!--小さな端末用（800px以下端末）メニュー-->
<nav id="menubar-s">
<ul>
<li><a href="/<?=$phpPath?>/">Home</a></li>
<li><a href="/<?=$phpPath?>/about/">About</a></li>
<li><a href="/<?=$phpPath?>/gallery/">Gallery</a></li>
<li><a href="/<?=$phpPath?>/link/">Link</a></li>
</ul>
</nav>

<!--ページの上部に戻る「↑」ボタン-->
<p class="nav-fix-pos-pagetop"><a href="#">↑</a></p>

<!--メニュー開閉ボタン-->
<div id="menubar_hdr" class="close"></div>

<!--メニューの開閉処理条件設定　800px以下-->
<script>
if (OCwindowWidth() <= 800) {
	open_close("menubar_hdr", "menubar-s");
}
</script>

</body>
</html>
