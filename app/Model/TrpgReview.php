<?php
class TrpgReview extends AppModel {
	public $belongsTo = array(
			'User' => array(
				'foreignKey' => 'reviewer_user_id'
			)
	);
}
