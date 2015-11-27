			<h2 id="news_detail">ニュース詳細</h2>
			<div class="news_detail_item">
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
				<div class="news_contents">
					<?php echo($newsRec['News']['contents']); ?>
				</div>
			</div>
