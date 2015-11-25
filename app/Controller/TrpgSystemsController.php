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
		$this->getTrpgSystems();
	}

	/**
	 * 画像取得。
	 *
	 * @param unknown $id ID
	 */
	public function image($id) {
		$trpgSystem = $this->TrpgSystem->findById($id);
		echo $trpgSystem['TrpgSystem']['image'];
	}

	/**
	 * TRPGシステム一覧の取得。
	 */
	protected function getTrpgSystems() {
		$sort = $this->request->query['sort'];
		if ($sort == 'ranking') {
 			$order = array('TrpgSystem.rank' => 'ASC', 'TrpgSystem.modified' => 'DESC');
		} else {
 			$order = array('TrpgSystem.introduction_order' => 'ASC', 'TrpgSystem.modified' => 'DESC');
		}
		$this->paginate = array(
				'TrpgSystem' => array(
					'order' => $order,
					'limit' => 10,
				)
		);
		$this->set('trpgSystems', $this->paginate('TrpgSystem'));
	}
}
