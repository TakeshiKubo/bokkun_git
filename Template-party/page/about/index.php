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
<link rel="stylesheet" href="/public/client/css/<?=$cssPath?>/style-opening.css">
<script src="/public/client/js/<?=$jsPath?>/fixmenu_pagetop.js"></script>
<script src="/public/client/js/<?=$jsPath?>/openclose.js"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

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

<section class="inner first">

<h2>各ページ１つ目のボックスは</h2>
<p><span class="color1">&lt;section class=&quot;inner first&quot;&gt;</span><br>
として下さい。<span class="color1">first</span>がないと、上のheaderブロックに重なってしまいます。<br>
２つ目以降のボックスは<span class="color1">&lt;section class=&quot;inner&quot;&gt;</span>のみでOKです。</p>

</section>

<section class="inner">

<h2>当テンプレートについて</h2>

<h3>当テンプレートはレスポンシブWEBデザインです</h3>
<p>パソコン、スマホ、タブレットなど、各端末サイズでレイアウトが自動で切り替わります。<br>
古いブラウザで閲覧した場合にCSSの一部が適用されない（角を丸くする加工やグラデーションなどの加工等）のでご注意下さい。</p>

<h3>各デバイスごとのレイアウトチェックは</h3>
<p>最終的なチェックは実際のタブレットやスマホで行うのがおすすめですが、臨時チェックは最新のブラウザで行う事もできます。ブラウザの幅を狭くしていくと、各端末サイズに合わせたレイアウトになります。</p>
<p>注意：cssはリアルタイムで反映されますが、javascript(js)はブラウザを再読み込みさせないと反映されないので、レイアウトが切り替わったらブラウザを再読み込みさせて下さい。javascriptは小さい端末用の開閉ブロックなどに使われています。</p>

<h3>各デバイス用のスタイル変更は</h3>
<p>cssフォルダの各cssファイルで行って下さい。詳しい説明も入っています。<br>
メインのスタイルはstyle.cssになります。<br>
前半はパソコン環境を含めた全端末の共通設定になります。中盤以降、各端末向けのスタイルが追加設定されています。<br>
media=&quot; (～)&quot;の「～」部分でcssを切り替えるディスプレイのサイズを設定しています。ここは必要に応じて変更も可能です。</p>

<h3>小さい端末（※幅800px以下）の環境でのみ</h3>
<p>メインメニューが折りたたみ式（３本バーアイコン化）になります。バーのスタイル設定もstyle.cssで行う事ができます。</p>

<h3>画像ベースは</h3>
<p>「base」フォルダに入っていますのでご自由にご活用下さい。<br>
写真の元素材を当社運営の<a href="https://photo-chips.com/">PHOTO-CHIPS</a>や<a href="https://decoruto.com/">DECORUTO</a>で配布している場合もございます。</p>

</section>

<section class="inner">

<h2>当テンプレートの使い方</h2>

<h3>初心者向けマニュアル公開中</h3>
<p>画像加工やテンプレートの編集方法、無料サーバーを使ってサイトを公開するなど動画をまじえてわかりやすく解説しています。<br>
<a href="https://template-party.com/file/" target="_blank">初心者向けマニュアルはこちら。</a></p>

<h3>注意：当テンプレートにはメインメニューが「２箇所」入っています</h3>
<p>パソコンなどの大きな端末「menubar（幅801px以上）」向けと、タブレットやスマホなどの小さな端末「menubar-s（幅800px以下）」向けがそれぞれ入っています。大きな端末向けは編集ソフトで見れると思いますが、小さな端末向けは見えないと思いますのでhtml側で編集して下さい。</p>

<h3>titleタグ、copyright、metaタグ、他の設定</h3>
<p><strong class="color1">titleタグの設定はとても重要です。念入りにワードを選んで適切に入力しましょう。</strong><br>
まず、htmlソースが見れる状態にして、<br>
<span class="look">&lt;title&gt;個人サイト向け 無料ホームページテンプレート tp_simple16&lt;/title&gt;</span><br>
を編集しましょう。<br>
あなたのホームページ名が「SAMPLE SITE」だとすれば、<br>
<span class="look">&lt;title&gt;SAMPLE SITE&lt;/title&gt;</span><br>
とすればＯＫです。SEO対策もするなら冒頭に重要なワードを入れておきましょう。</p>
<p><strong class="color1">copyrightを変更しましょう。</strong><br>
続いてhtmlの下の方にある、<br>
<span class="look">Copyright&copy; SAMPLE SITE All Rights Reserved.</span><br>
の部分もあなたのサイト名に変更します。</p>
<p><strong class="color1">metaタグを変更しましょう。</strong><br>
htmlソースが見える状態にしてmetaタグを変更しましょう。</p>
<p>ソースの上の方に、<br>
<span class="look">content=&quot;ここにサイト説明を入れます&quot;</span><br>
という部分がありますので、テキストをサイトの説明文に入れ替えます。検索結果の文面に使われる場合もありますので、見た人が来訪したくなるような説明文を簡潔に書きましょう。</p>
<p>続いて、その下の行の<br>
<span class="look">content=&quot;キーワード１,キーワード２,～～～&quot;</span><br>
も設定します。ここはサイトに関係のあるキーワードを入れる箇所です。10個前後ぐらいあれば充分です。キーワード間はカンマ「,」で区切ります。</p>
<p><strong class="color1">h1ロゴのaltタグも変更しましょう。</strong><br>
  html側に、<br>
<span class="look">alt=&quot;SAMPLE SITE&quot;</span><br>
となっている箇所があるので、この部分もあなたのサイト名に変更しましょう。</p>

<h3>上部のロゴ画像について</h3>
<p>文字なしの土台画像がbaseフォルダに入っていますのでそれにサイト名をのせてimagesフォルダに上書きして下さい。画像の大きさは自由に変更してもらっても構いませんがある程度大きくしておいた方が高解像度の端末で鮮明に見えます。</p>
<p><strong class="color1">ロゴサイズ変更は</strong><br>
cssフォルダのstyle.cssの「header #logo img」のwidthの数字で変更できます。各端末サイズごとに設定がある場合があるので注意して下さい。</p>

<h3>トップページのアニメーションについて</h3>
<p>トップページアニメーションが動くのはIE10以降です。それ以前はアニメーション終了時点での画像が固定表示されます。</p>
<p><strong class="color1">アニメーション用の画像を置き換えたい場合</strong><br>
幅と高さを700pxにすれば、テンプレートの配置バランスを保てます。<br>
画像の読み込みは、各ページ下部の、<br>
&lt;!--オープニングアニメーション--&gt;<br>
のブロックです。実は9枚全て別々の画像にする事もできるのですが、読み込みに負荷がかかるので統一した画像を使っています。<br>
配置バランスや大きさの調整などは、cssフォルダのstyle-opening.cssで行う事ができます。</p>

<h3>リストタグを使いたい場合の注意点</h3>
<p>そのままではリストマークが出ませんので、リストタグを使う場合は以下のようなスタイルを追加して下さい。</p>
<p>&lt;ul <span class="color1">class=&quot;disc&quot;</span>&gt;<br>
&lt;li&gt;リストタグ&lt;/li&gt;<br>
&lt;li&gt;リストタグ&lt;/li&gt;<br>
&lt;li&gt;リストタグ&lt;/li&gt;<br>
&lt;/ul&gt;
</p>
<p>↓出力例</p>
<ul class="disc">
<li>リストタグ</li>
<li>リストタグ</li>
<li>リストタグ</li>
</ul>
<ol>
<li>olタグはそのままででます。</li>
<li>olタグはそのままででます。</li>
<li>olタグはそのままででます。</li>
<li>olタグはそのままででます。</li>
</ol>

<h3>スクロール中に出る「↑」アイコンについて</h3>
<p>fixmenu_pagetop.jsで動作の制御を、cssフォルダのstyle.css内の<br>
/*PAGE TOP（↑）設定<br>
でボタンデザインを設定しています。<br>
ボタンの出現ポイントは、現在350pxの場所になっています。変更したい場合はfixmenu_pagetop.jsの34行目あたりにある、<br>
offsettop = 350;<br>
の350を変更して下さい。</p>

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
