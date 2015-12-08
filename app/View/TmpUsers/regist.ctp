<h2 id="tmp_users_regist">新規登録</h2>
<?php echo $this->Form->create('TmpUser'); ?>
<p class="message">
	メールアドレスを入力してください。入力されたメールアドレス宛に TRPGランキング の登録認証メールが送信されます。<br>
	TRPGランキングにユーザ登録すると、TRPGを評価、レビューできるようになります。<br>
</p>
<table class="user_table">
	<tr>
		<th>
			<?php echo($this->Form->label('email', 'メールアドレス')); ?>
		</th>
		<td>
			<?php echo($this->Form->text('email', array('size' => '50', 'maxlength' => '255'))); ?>
			<?php echo($this->Form->error('email')); ?>
		</td>
	</tr>
	<tr>
		<th>
			<?php echo($this->Form->label('captcha', 'キャプチャコード')); ?>
		</th>
		<td>
			<?php echo($this->Html->image('/tmp_users/captcha')); ?><br>
			<?php echo($this->Form->text('captcha', array('size' => '30'))); ?>
			<?php echo($this->Form->error('captcha')); ?>
		</td>
	</tr>
</table>
<div style="width:500px; text-align: center;">
	<?php echo($this->Form->end('送信')); ?>
</div>
