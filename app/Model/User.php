<?php
class User extends AppModel {
	public $validate = array(
			'username' => array(
				array(
					'rule' => array('alphaNumeric'),
					'message' => '半角英数で入力してください'
				),
				array(
					'rule' => array('maxLength', 10),
					'message' => '10文字以下で入力してください'
				),
				array(
					'rule' => array('isUnique'),
					'message' => 'すでに使用されています'
				),
			),
			'nickname' => array(
				array(
					'rule' => array('maxLength', 10),
					'message' => '10文字以下で入力してください'
				),
				array(
					'rule' => array('isUnique'),
					'message' => 'すでに使用されています'
				),
			),
			'password' => array(
				array(
					'rule' => array('alphaNumeric'),
					'message' => '半角英数で入力してください'
				),
				array(
					'rule' => array('maxLength', 10),
					'message' => '10文字以下で入力してください'
				),
				array(
					'rule' => array('confirm'),
					'message' => 'パスワードが一致しません'
				),
			),
			'password_confirm' => array(
				array(
					'rule' => array('alphaNumeric'),
					'message' => '半角英数で入力してください'
				),
				array(
					'rule' => array('maxLength', 10),
					'message' => '10文字以下で入力してください'
				),
			),
	);
}
