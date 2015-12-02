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
<?php
	$categories = $this->requestAction('categories/getList');
?>
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
							'width' => '541',
							'height' => '84',
							'alt' => 'TRPGランキング',
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
		<li><?php echo($this->Html->link('ホーム', '/home')); ?></li>
		<li><?php echo($this->Html->link('紹介', '/trpg_systems?sort=introduction&'.$categoryIdCond)); ?></li>
		<li><?php echo($this->Html->link('ランキング', '/trpg_systems?sort=ranking&'.$categoryIdCond)); ?></li>
		<li><?php echo($this->Html->link('ニュース', '/news')); ?></li>
	</ul>
	<!-- ヘッダー ここまで -->
	<!-- レフトとメイン-->
	<div class="left_main">
		<!-- レフト -->
		<div class="left">
			<div id="category_div">
				<h2 id="category">カテゴリ</h2>
				<?php echo($this->Html->link('TRPG', '/trpg_systems?'.$sortCond)); ?>
				<ul id="category_items">
					<?php foreach ($categories as $category): ?>
					<li><?php echo($this->Html->link($category['Category']['name'], '/trpg_systems?'.$sortCond.'&category_id='.$category['Category']['id'])); ?></li>
					<?php endforeach; ?>
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
	<!-- 開発中のみ -->
	<?php echo $this->element('sql_dump'); ?>
	<!-- フッター ここまで -->
</div>
</body>
</html>
