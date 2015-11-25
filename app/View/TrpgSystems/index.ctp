			<h2 id="introduction">紹介</h2>
			<?php foreach ($trpgSystems as $trpgSystem): ?>
			<div class="trpg_item">
				<div class="trpg_item_left">
					<div class="trpg_image">
						<?php
							echo($this->Html->image(
								'/home/image/'.$trpgSystem['TrpgSystem']['id'],
								array(
									'url' => '/trpg_systems/view/'.$trpgSystem['TrpgSystem']['id'],
									'width' => '100',
									'alt' => $trpgSystem['TrpgSystem']['title'],
								)
							));
						?>
					</div>
				</div>
				<div class="trpg_item_center">
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
						<a href="introduction_fantasy.html"><?php echo($trpgSystem['Category']['name']); ?></a>
					</div>
				</div>
				<div class="trpg_item_right">
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
