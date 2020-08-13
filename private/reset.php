<?php
require __DIR__. "/common/require.php";
require_once "common.php";
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset='utf-8' />
        <title>カウンタリセット</title>
        <link rel="stylesheet" type="text/css" href="./client/css/common.css">
    </head>
    <?php require_once "./common/header.php" ?>
    <body>
    	<div class="adminContents">
    		<time></time>
    		<script>
    			// 時間計測用のスクリプト
    			var t = new TimeUpDate();
console.log('xxx');
    			/////////////////// 時間関連の処理 ///////////////////

				function TimeUpDate() {
				    this.time = new Time();
				    console.log(document.getElementsByTagName('time'));
				    document.getElementsByTagName('time')[0].innerHTML = this.time.nowTime + '<br/>';
//				    requestAnimationFrame(main);
				}

				function Time() {
				    this.sourceTime = new Date();
				    this.nowTime =
				    new Year(this.sourceTime).days +
				    this.sourceTime.getHours() + '：' +
				    this.sourceTime.getMinutes() + '：' +
				    this.sourceTime.getSeconds();
				}

				function Year(date) {
					this.days =
					date.getFullYear() + '/' +
					(date.getMonth() + 1) + '/' +
					date.getDate() + ' ';
				}
    		</script>

			<?php

//			exit;						// テスト中断
			count_reset();
			function count_reset() {
				echo "<div align='center'><strong>セッションを初期化しました。</strong></div>";

				session_destroy();
			}



			?>
		</div>

		<?php require_once "./common/footer.php"; ?>
	</body>
</html>