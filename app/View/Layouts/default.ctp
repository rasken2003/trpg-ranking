<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="Keywords" content="TRPG,ランキング">
<meta name="Description" content="TRPGのシステムを紹介しています。また、ユーザの評価をもとに、TRPGのシステムをランキング化しています。TRPGのシステムを検索したり、カテゴリごとに一覧表示したりすることができます。
さらに、TRPGに関するニュースを掲載しています。">
<title>TRPGランキング</title>
<?php
	echo $this->Html->css('style');
?>
</head>
<body>
<div class="wrapper">
	<!-- ヘッダー -->
	<div id="logo_login">
		<div id="logo_login_center">
			<h1 id="logo">
				<?php
					echo($this->Html->Image(
						'logo.png',
						array(
							'url' => '/home',
							'alt' => 'TRPGランキング',
							'width' => '541',
							'height' => '84'
						)
					));
				?>
			</h1>
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
			<?php echo $this->fetch('content'); ?>
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
