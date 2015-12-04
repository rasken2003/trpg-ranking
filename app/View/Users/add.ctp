<h2 id="users_add">新規登録</h2>
<?php echo $this->Form->create('User', array('url' => 'add')); ?>
<p class="message">
	メールアドレスは認証されました。<br>
	ユーザ情報を登録してください。<br>
</p>
<table class="user_table">
	<tr>
		<th>
			<?php echo($this->Form->label('username', 'ユーザ名')); ?>
		</th>
		<td>
			<?php echo($this->Form->text('username', array('size' => '10', 'maxlength' => '100'))); ?>
			<p class="message">
				半角英数で10文字までです。<br>
			</p>
			<?php echo($this->Form->error('username')); ?>
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
	<?php echo($this->Form->end('登録')); ?>
</div>
