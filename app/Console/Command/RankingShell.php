<?php
/**
 * ランキング更新シェル。
 *
 * @author Hidemasa Aoki
 */
class RankingShell extends AppShell {

	/**
	 * TRPGシステムモデル、TRPGレビューモデル。
	 */
	public $uses = array('TrpgSystem', 'TrpgReview');

	/**
	 * 実行。
	 */
	public function execute() {

		// 評価値の更新
		$this->updateEvaluationValue();

		// ランキングの更新
		$this->updateRank();
	}

	/**
	 * 評価値の更新。
	 */
	protected function updateEvaluationValue() {
		$trpgSystems = $this->TrpgSystem->find('all',
				array('order' => array('TrpgSystem.id' => 'ASC')));
		foreach ($trpgSystems as $trpgSystem) {
			$trpgReview = $this->TrpgReview->find('first',
					array(
						'fields' => array('truncate(avg(TrpgReview.evaluation_value), 2) as avg_evaluation_value'),
						'conditions' => array('TrpgReview.trpg_system_id' => $trpgSystem['TrpgSystem']['id']),
					)
			);
			if (isset($trpgReview[0]['avg_evaluation_value'])) {
				$avgEvaluationValue = $trpgReview[0]['avg_evaluation_value'];
			} else {
				$avgEvaluationValue = 0.00;
			}
			$this->TrpgSystem->id = $trpgSystem['TrpgSystem']['id'];
			$this->TrpgSystem->saveField('evaluation_value', $avgEvaluationValue);
		}
	}

	/**
	 * ランキングの更新。
	 */
	protected function updateRank() {
		$trpgSystems = $this->TrpgSystem->find('all',
				array('order' => array(
						'TrpgSystem.evaluation_value' => 'DESC',
						'TrpgSystem.introduction_order' => 'ASC',
				))
		);
		$index = 1;
		$rank = 1;
		$oldEvaluationValue = 0;
		foreach ($trpgSystems as $trpgSystem) {
			if ($oldEvaluationValue != $trpgSystem['TrpgSystem']['evaluation_value']) {
				$rank = $index;
				$oldEvaluationValue = $trpgSystem['TrpgSystem']['evaluation_value'];
			}
			$this->TrpgSystem->id = $trpgSystem['TrpgSystem']['id'];
			$this->TrpgSystem->saveField('rank', $rank);
			$index++;
		}
	}
}
