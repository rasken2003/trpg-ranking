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
		// カテゴリとソートの組み合わせを対処する。
		if (isset($this->request->query['sort'])) {
			$sort = $this->request->query['sort'];
			if ($sort == 'ranking') {
	 			$order = array('TrpgSystem.rank' => 'ASC', 'TrpgSystem.modified' => 'DESC');
			} else {
	 			$order = array('TrpgSystem.introduction_order' => 'ASC', 'TrpgSystem.modified' => 'DESC');
			}
		} else {
			$order = array('TrpgSystem.introduction_order' => 'ASC', 'TrpgSystem.modified' => 'DESC');
		}
		if (isset($this->request->query['category_id'])) {
			$categoryId = $this->request->query['category_id'];
			$conditions = array('TrpgSystem.category_id' => $categoryId);
		}
		$trpgSystemArray = array();
		if (isset($order)) {
			$trpgSystemArray['order'] = $order;
		}
		$trpgSystemArray['limit'] = 10;
		if (isset($conditions)) {
			$trpgSystemArray['conditions'] = $conditions;
		}
		$this->paginate = array(
				'TrpgSystem' => $trpgSystemArray
		);
		$this->set('trpgSystems', $this->paginate('TrpgSystem'));
	}
}
