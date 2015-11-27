<?php
	if (isset($categoryId)) {
		$categoryIdCond = 'category_id='.$categoryId;
	} else {
		$categoryIdCond = '';
	}
	if (isset($sort)) {
		$sortCond = 'sort='.$sort;
	} else {
		$sortCond = '';
	}
?>
			<h2 id="introduction"><?php echo($subTitle); ?></h2>
			<div class="page_count">
				<?php echo $this->Paginator->counter('全{:count}件中 {:start}件目から{:end}件目（{:current}件）を表示中'); ?><br>
				<?php echo $this->Paginator->counter('ページ {:page} / {:pages}'); ?><br>
			</div>
			<?php foreach ($trpgSystems as $trpgSystem): ?>
			<div class="trpg_item">
				<div class="trpg_item_left">
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
						<?php echo($this->Html->link($trpgSystem['Category']['name'], '/trpg_systems?'.$sortCond.'&category_id='.$trpgSystem['Category']['id'])); ?>
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
			<div class="paging">
				<div class="paging_left">
					<?php echo $this->Paginator->prev('<< 最初へ'); ?>
					<?php echo $this->Paginator->prev('< 前へ'); ?>
				</div>
				<div class="paging_center">
					<?php echo $this->Paginator->numbers(); ?>&nbsp;
				</div>
				<div class="paging_right">
					<?php echo $this->Paginator->next('次へ >'); ?>
					<?php echo $this->Paginator->next('最後へ >>'); ?>
				</div>
			</div>
