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
			<h2 id="review_detail">レビュー詳細</h2>
			<div class="review_detail_item">
				<div class="review_title">
					<?php
						echo($this->Html->link(
							h($trpgReview['TrpgReview']['title']),
							'/trpg_reviews/view/'.$trpgReview['TrpgReview']['id'].'?'.$sortCond.'&'.$categoryIdCond
						));
					?>
				</div>
				<div class="review_evaluation">
					<div class="review_evaluation_image">
						<?php
							echo($this->Html->image(
								'star'.floor($trpgReview['TrpgReview']['evaluation_value']).'.png',
								array(
									'width' => '100',
									'height' => '20',
									'alt' => '☆'.floor($trpgReview['TrpgReview']['evaluation_value']),
								)
							));
						?>
					</div>
					<div class="review_evaluation_value">
						<?php echo($trpgReview['TrpgReview']['evaluation_value']); ?>
					</div>
				</div>
				<div class="review_contents">
					<?php echo(nl2br(h($trpgReview['TrpgReview']['contents']))); ?>
				</div>
				<div class="review_reviewer">
					レビュアー：<?php echo(h($trpgReview['User']['username'])); ?>
				</div>
				<div class="review_update_date">
					更新日時：<?php echo($trpgReview['TrpgReview']['modified']); ?>
				</div>
			</div>
