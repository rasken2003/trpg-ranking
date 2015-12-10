<h2 id="users_edit">ユーザ設定</h2>
<?php echo $this->Form->create('User', array('type' => 'post', 'url' => 'edit')); ?>
<p class="message">
	ユーザ情報を変更できます。<br>
</p>
<?php echo($this->Form->hidden('id')); ?>
<?php echo($this->Form->hidden('username')); ?>
<table class="user_table">
	<tr>
		<th>
			<?php echo($this->Form->label('username', 'ユーザ名')); ?>
		</th>
		<td>
			<?php echo($this->request->data['User']['username']); ?>
		</td>
	</tr>
	<tr>
		<th>
			<?php echo($this->Form->label('nickname', 'ニックネーム')); ?>
		</th>
		<td>
			<?php echo($this->Form->text('nickname', array('size' => '20', 'maxlength' => '100'))); ?>
			<p class="message">
				レビュアーの表示名に利用されます。全角文字も入力可能です。10文字までです。<br>
			</p>
			<?php echo($this->Form->error('nickname')); ?>
		</td>
	</tr>
	<tr>
		<th>
			<?php echo($this->Form->label('password', 'パスワード')); ?>
		</th>
		<td>
			<?php echo($this->Form->password('password', array('size' => '10', 'maxlength' => '100'))); ?>
			<p class="message">
				半角英数で10文字までです。<br>
			</p>
			<?php echo($this->Form->error('password')); ?>
		</td>
	</tr>
	<tr>
		<th>
			<?php echo($this->Form->label('password_confirm', 'パスワード(確認用)')); ?>
		</th>
		<td>
			<?php echo($this->Form->password('password_confirm', array('size' => '10', 'maxlength' => '100'))); ?>
			<p class="message">
				確認のため、もう一度入力してください。<br>
			</p>
			<?php echo($this->Form->error('password_confirm')); ?>
		</td>
	</tr>
</table>
<div style="text-align: center;">
	<?php echo($this->Form->end('変更')); ?>
</div>
