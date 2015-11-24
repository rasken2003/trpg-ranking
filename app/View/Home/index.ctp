			<!-- センター -->
			<div class="home_center">
				<h2 id="news">ニュース</h2>
				<div class="home_news_item">
					<div class="news_title">
						<a href="news_detail_2.html">TRPGランキングの画面定義が終了！</a>
					</div>
					<div class="news_summary">
						TRPGランキングの企画を書き、画面定義が終了しました！
					</div>
					<div class="news_delivery_time">
						2015/10/22 12:58
					</div>
				</div>
				<div class="home_news_item">
					<div class="news_title">
						<a href="news_detail.html">TRPGランキングの開発がスタート！</a>
					</div>
					<div class="news_summary">
						TRPGランキングの開発がスタートしました！開発完了が待たれます！
					</div>
					<div class="news_delivery_time">
						2015/10/21 14:46
					</div>
				</div>
			</div>
			<!-- センター ここまで -->
			<!-- ライト -->
			<div class="home_right">
				<h2 id="ranking">ランキング</h2>
				<?php foreach ($trpgSystems as $trpgSystem): ?>
				<div class="home_trpg_item">
					<div class="home_trpg_item_left">
						<div class="trpg_image">
							<?php
								echo($this->Html->Image(
									'/home/image/'.$trpgSystem['TrpgSystem']['id'],
									array(
										'url' => '/home',
										'width' => '100',
										'alt' => $trpgSystem['TrpgSystem']['title'],
									)
								));
							?>
						</div>
					</div>
					<div class="home_trpg_item_center">
						<div class="trpg_title">
							<a href="trpg_detail.html"><?php echo($trpgSystem['TrpgSystem']['title']); ?></a>
						</div>
						<div class="trpg_summary">
							<?php echo($trpgSystem['TrpgSystem']['summary']); ?>
						</div>
						<div class="trpg_category">
							<a href="introduction_fantasy.html"><?php echo($trpgSystem['Category']['name']); ?></a>
						</div>
					</div>
					<div class="home_trpg_item_right">
						<div class="trpg_rank">
							第<?php echo($trpgSystem['TrpgSystem']['rank']); ?>位
						</div>
						<div class="trpg_evaluation_image">
							<?php
								echo($this->Html->Image(
									'star'.floor($trpgSystem['TrpgSystem']['evaluation_value']).'.png',
									array(
										'width' => '100',
										'height' => '20',
										'alt' => '☆'.floor($trpgSystem['TrpgSystem']['evaluation_value']),
									)
								));
							?>
						</div>
						<div class="trpg_evaluation_value">
							<?php echo($trpgSystem['TrpgSystem']['evaluation_value']); ?>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			<!-- ライト ここまで -->
