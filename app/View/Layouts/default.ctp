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
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-71239932-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<?php
	App::uses('AuthComponent', 'Controller/Component');
	$categories = $this->requestAction('categories/getList');
?>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
				<?php if (is_null(AuthComponent::user())): ?>
				<li><?php echo($this->Html->link('ログイン', '/users/login')); ?></li>
				<li><?php echo($this->Html->link('新規登録', '/tmp_users/regist')); ?></li>
				<?php else: ?>
				<li><div class="message"><?php echo(AuthComponent::user('nickname')); ?>さん</div></li>
				<li><?php echo($this->Html->link('ユーザ設定', '/users/edit')); ?></li>
				<li><?php echo($this->Html->link('ログアウト', '/users/logout')); ?></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
	<div id="social">
		<a href="https://twitter.com/share" class="twitter-share-button"{count} data-lang="ja">ツイート</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		<div class="fb-like" layout="button_count"></div>
	</div>
	<div id="search">
		<?php
			echo($this->Form->create('TrpgSystems', array(
				'type' => 'get',
				'url' => '/trpg_systems/index'
			)));
		?>
			<div>
				<?php
					echo($this->Form->text('search_keyword', array('size' => 50)));
				?>
				<?php
					echo($this->Form->end(array(
						'label' => '検索',
						'id' => 'search',
						'div' => false,
					)))
				?>
			</div>
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
			<?php echo $this->Flash->render(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<!-- メイン ここまで -->
	</div>
	<!-- レフトとメイン ここまで -->
	<!-- フッター -->
	<div id="contact">
		<span class="message">
			お問い合わせはこちらまで
		</span>
		<a href="https://twitter.com/intent/tweet?screen_name=rasken2003" class="twitter-mention-button" data-lang="ja">Tweet to @rasken2003</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	</div>
	<div id="footer">
		<p>&copy;Copyright Rasken. All rights reserved.</p>
	</div>
	<!-- フッター ここまで -->
</div>
</body>
</html>
