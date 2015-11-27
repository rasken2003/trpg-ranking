			<h2 id="news">ニュース</h2>
			<div class="page_count">
				<?php echo $this->Paginator->counter('全{:count}件中 {:start}件目から{:end}件目（{:current}件）を表示中'); ?><br>
				<?php echo $this->Paginator->counter('ページ {:page} / {:pages}'); ?><br>
			</div>
			<?php foreach ($news as $newsRec): ?>
			<div class="news_item">
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
