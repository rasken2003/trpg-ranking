<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="Keywords" content="TRPG,ランキング">
<title>TRPGランキング</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="wrapper">
	<!-- ヘッダー -->
	<div id="logo_login">
		<div id="logo_login_center">
			<h1 id="logo"><a href="index.html"><img src="images/logo.png" width="541" height="84" alt="TRPGランキング"></a></h1>
		</div>
		<div id="logo_login_right">
			<ul id="login">
				<li><a href="login.html">ログイン</a></li>
				<li><a href="userregist.html">新規登録</a></li>
			</ul>
		</div>
	</div>
	<div id="search">
		<form method="GET" action="index.html">
			<div>
				<input type="text" name="searchkeyword" value="">
				<input type="submit" id="search" name="search" value="検索">
			</div>
		</form>
	</div>
	<ul id="nav">
		<li><a href="index.html">ホーム</a></li>
		<li><a href="introduction.html">紹介</a></li>
		<li><a href="ranking.html">ランキング</a></li>
		<li><a href="news.html">ニュース</a></li>
	</ul>
	<!-- ヘッダー ここまで -->
	<!-- レフトとメイン-->
	<div class="left_main">
		<!-- レフト -->
		<div class="left">
			<div id="category_div">
				<h2 id="category">カテゴリ</h2>
				<a href="index.html">TRPG</a>
				<ul id="category_items">
					<li><a href="introduction_general.html">汎用</a></li>
					<li><a href="introduction_fantasy.html">ファンタジー</a></li>
					<li><a href="introduction_horror.html">ホラー</a></li>
				</ul>
			</div>
		</div>
		<!-- レフト ここまで -->
		<!-- メイン -->
		<div class="main">
			<h2 id="introduction">紹介</h2>
			<div class="trpg_item">
				<div class="trpg_item_left">
					<div class="trpg_image">
						<a href="trpg_detail.html"><img src="images/sword_world20.jpg" width="100" alt="ソードワールド2.0"></a>
					</div>
				</div>
				<div class="trpg_item_center">
					<div class="trpg_title">
						<a href="trpg_detail.html">ソードワールド2.0</a>
					</div>
					<div class="trpg_summary">
						ラクシアと呼ばれる世界を舞台にしたファンタジーRPG。
					</div>
					<div class="trpg_category">
						<a href="introduction_fantasy.html">ファンタジー</a>
					</div>
				</div>
				<div class="trpg_item_right">
					<div class="trpg_rank">
						第1位
					</div>
					<div class="trpg_evaluation_image">
						<img src="images/star5.png" width="100" height="20" alt="☆5">
					</div>
					<div class="trpg_evaluation_value">
						5.00
					</div>
				</div>
			</div>
			<div class="trpg_item">
				<div class="trpg_item_left">
					<div class="trpg_image">
						<a href="trpg_detail_gurps.html"><img src="images/GURPS.jpg" width="100" alt="ガープス"></a>
					</div>
				</div>
				<div class="trpg_item_center">
					<div class="trpg_title">
						<a href="trpg_detail_gurps.html">ガープス</a>
					</div>
					<div class="trpg_summary">
						汎用テーブルトークRPGのルール。
					</div>
					<div class="trpg_category">
						<a href="introduction_general.html">汎用</a>
					</div>
				</div>
				<div class="trpg_item_right">
					<div class="trpg_rank">
						第3位
					</div>
					<div class="trpg_evaluation_image">
						<img src="images/star3.png" width="100" height="20" alt="☆3">
					</div>
					<div class="trpg_evaluation_value">
						3.50
					</div>
				</div>
			</div>
			<div class="trpg_item">
				<div class="trpg_item_left">
					<div class="trpg_image">
						<a href="trpg_detail_cthulhu.html"><img src="images/CALL_OF_CTHULHU.jpg" width="100" alt="クトゥルフ神話 TRPG"></a>
					</div>
				</div>
				<div class="trpg_item_center">
					<div class="trpg_title">
						<a href="trpg_detail_cthulhu.html">クトゥルフ神話 TRPG</a>
					</div>
					<div class="trpg_summary">
						「クトゥルフ神話」を題材とした、ホラーTRPG。
					</div>
					<div class="trpg_category">
						<a href="introduction_horror.html">ホラー</a>
					</div>
				</div>
				<div class="trpg_item_right">
					<div class="trpg_rank">
						第2位
					</div>
					<div class="trpg_evaluation_image">
						<img src="images/star4.png" width="100" height="20" alt="☆4">
					</div>
					<div class="trpg_evaluation_value">
						4.50
					</div>
				</div>
			</div>
		</div>
		<!-- メイン ここまで -->
	</div>
	<!-- レフトとメイン ここまで -->
	<!-- フッター -->
	<div id="footer">
		<p>&copy;Copyright Rasken. All rights reserved.</p>
	</div>
	<!-- フッター ここまで -->
</div>
</body>
</html>
