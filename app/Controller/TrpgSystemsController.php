<?php
/**
 * TRPGシステムのコントローラー。
 *
 * @author Hidemasa Aoki
 */
class TrpgSystemsController extends AppController {

	/**
	 * 初期表示。
	 */
	public function index() {

		// TRPGシステム一覧の取得
		$this->set('trpgSystems', $this->getTrpgSystems());
	}

	/**
	 * TRPGシステム一覧の取得。
	 */
	protected function getTrpgSystems() {
		$options = array(
//				'order' => array('TrpgSystem.rank ASC', 'TrpgSystem.modified DESC'),
				'order' => array('TrpgSystem.introduction_order ASC', 'TrpgSystem.modified DESC'),
				'limit' => 5,
		);
		return $this->TrpgSystem->find('all', $options);
	}
}
