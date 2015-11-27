			<!-- センター -->
			<div class="home_center">
				<h2 id="news">ニュース</h2>
				<?php foreach($news as $newsRec): ?>
				<div class="home_news_item">
					<div class="news_title">
						<?php
							echo($this->Html->link(
								$newsRec['News']['title'],
								'/news/view/'.$newsRec['News']['id']
							));
						?>
					</div>
					<div class="news_summary">
						<?php echo($newsRec['News']['summary']); ?>
					</div>
					<div class="news_delivery_time">
						<?php echo($newsRec['News']['delivery_time']); ?>
					</div>
				</div>
				<?php endforeach; ?>
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
								echo($this->Html->image(
									'/trpg_systems/image/'.$trpgSystem['TrpgSystem']['id'],
									array(
										'url' => '/trpg_systems/view/'.$trpgSystem['TrpgSystem']['id'],
										'width' => '100',
										'alt' => $trpgSystem['TrpgSystem']['title'],
									)
								));
							?>
						</div>
					</div>
					<div class="home_trpg_item_center">
						<div class="trpg_title">
							<?php
								echo($this->Html->link(
									$trpgSystem['TrpgSystem']['title'],
									'/trpg_systems/view/'.$trpgSystem['TrpgSystem']['id']
								));
							?>
						</div>
						<div class="trpg_summary">
							<?php echo($trpgSystem['TrpgSystem']['summary']); ?>
						</div>
						<div class="trpg_category">
							<?php echo($this->Html->link($trpgSystem['Category']['name'], '/trpg_systems?&category_id='.$trpgSystem['Category']['id'])); ?>
						</div>
					</div>
					<div class="home_trpg_item_right">
						<div class="trpg_rank">
							第<?php echo($trpgSystem['TrpgSystem']['rank']); ?>位
						</div>
						<div class="trpg_evaluation_image">
							<?php
								echo($this->Html->image(
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
