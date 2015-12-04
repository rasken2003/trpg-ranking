			<h2 id="review">レビュー投稿・編集</h2>
			<?php echo $this->Form->create('TrpgReview', array('type' => 'post', 'url' => 'update')); ?>
			<?php echo($this->Form->hidden('id')); ?>
			<?php echo($this->Form->hidden('trpg_system_id')); ?>
			<?php echo($this->Form->hidden('sort')); ?>
			<?php echo($this->Form->hidden('category_id')); ?>
			<table class="review_table">
				<tr>
					<th>
						<?php echo($this->Form->label('title', 'タイトル')); ?>
					</th>
					<td>
						<?php echo($this->Form->text('title', array('size' => '70', 'maxlength' => '100'))); ?>
						<p class="message">
							100文字までです。<br>
						</p>
						<?php echo($this->Form->error('title')); ?>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo($this->Form->label('evaluation_value', '評価値')); ?>
					</th>
					<td>
						<?php echo($this->Form->select('evaluation_value',
								array(
									'1' => '☆1',
									'2' => '☆☆2',
									'3' => '☆☆☆3',
									'4' => '☆☆☆☆4',
									'5' => '☆☆☆☆☆5'
								)
						)); ?>
						<p class="message">
							選択してください。<br>
						</p>
						<?php echo($this->Form->error('evaluation_value')); ?>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo($this->Form->label('contents', '内容')); ?>
					</th>
					<td>
						<?php echo($this->Form->textarea('contents', array('rows' => '20', 'cols' => '70'))); ?>
						<p class="message">
							2000文字までです。<br>
						</p>
						<?php echo($this->Form->error('contents')); ?>
					</td>
				</tr>
			</table>
			<div style="text-align: center;">
				<?php echo($this->Form->end('投稿・編集')); ?>
			</div>
