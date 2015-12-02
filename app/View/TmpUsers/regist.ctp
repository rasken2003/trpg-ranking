<h2 id="tmp_users_regist">新規登録</h2>
<?php echo $this->Form->create('TmpUser'); ?>
<p class="message">
	メールアドレスを入力してください。入力されたメールアドレス宛に TRPGランキング の登録認証メールが送信されます。<br>
	TRPGランキングにユーザ登録すると、TRPGを評価、レビューできるようになります。<br>
</p>
<table>
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
		</th>
		<td style="text-align: center;">
			<?php echo($this->Form->end('送信')); ?>
		</td>
	</tr>
</table>
