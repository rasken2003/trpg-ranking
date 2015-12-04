<?php
class TrpgReview extends AppModel {
	public $belongsTo = array(
			'User' => array(
				'foreignKey' => 'reviewer_user_id'
			)
	);

	public $validate = array(
			'title' => array(
				array(
					'rule' => array('maxLength', 100),
					'message' => '100文字以下で入力してください'
				),
			),
			'evaluation_value' => array(
				array(
					'rule' => array('range', 0, 6),
					'message' => '不正な数値です'
				),
			),
			'contents' => array(
				array(
					'rule' => array('maxLength', 2000),
					'message' => '2000文字以下で入力してください'
				),
			),
	);
}
