<h2 id="users_login">ログイン</h2>
<?php echo $this->Form->create('User'); ?>
<table class="user_table">
	<tr>
		<th>
			<?php echo($this->Form->label('username', 'ユーザ名')); ?>
		</th>
		<td>
			<?php echo($this->Form->text('username', array('size' => '10', 'maxlength' => '255'))); ?>
			<?php echo($this->Form->error('username')); ?>
		</td>
	</tr>
	<tr>
		<th>
			<?php echo($this->Form->label('password', 'パスワード')); ?>
		</th>
		<td>
			<?php echo($this->Form->password('password', array('size' => '10', 'maxlength' => '255'))); ?>
			<?php echo($this->Form->error('password')); ?>
		</td>
	</tr>
</table>
<div style="width:300px; text-align: center;">
	<?php echo($this->Form->end('ログイン')); ?>
</div>
<div style="width:300px; text-align: center; margin: 10px 0 10px 0;">
	<?php echo($this->Html->link('新規登録', '/tmp_users/regist')); ?>
</div>
<div style="width:300px; text-align: center; margin: 10px 0 10px 0;">
	<?php echo($this->Html->link('Twitterでログイン', '/users/twitter_login')); ?>
</div>
<div style="width:300px; text-align: center; margin: 10px 0 10px 0;">
	<?php echo($this->Html->link('Facebookでログイン', '/users/facebook')); ?>
</div>
