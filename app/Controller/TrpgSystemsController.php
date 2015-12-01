<?php
/**
 * TRPGシステムのコントローラー。
 *
 * @author Hidemasa Aoki
 */
class TrpgSystemsController extends AppController {

	/**
	 * TRPGシステム、TRPGレビュー
	 */
	public $uses = array('TrpgSystem', 'TrpgReview');

	/**
	 * 初期表示。
	 */
	public function index() {

		// TRPGシステム一覧の取得
		$this->getTrpgSystems();
	}

	/**
	 * TRPGシステム一覧の取得。
	 */
	protected function getTrpgSystems() {
		if (isset($this->request->query['sort'])) {
			$sort = $this->request->query['sort'];
			if ($sort == 'ranking') {
	 			$order = array('TrpgSystem.rank' => 'ASC', 'TrpgSystem.modified' => 'DESC');
	 			$subTitle = 'ランキング';
			} else {
	 			$order = array('TrpgSystem.introduction_order' => 'ASC', 'TrpgSystem.modified' => 'DESC');
	 			$subTitle = '紹介';
			}
		} else {
			$order = array('TrpgSystem.introduction_order' => 'ASC', 'TrpgSystem.modified' => 'DESC');
	 		$subTitle = '紹介';
		}
		if (isset($this->request->query['category_id'])) {
			$categoryId = $this->request->query['category_id'];
			$conditions = array('TrpgSystem.category_id' => $categoryId);
		}
		if (isset($subTitle)) {
			$this->set("subTitle", $subTitle);
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
		if (isset($sort)) {
			$this->set('sort', $sort);
		}
		if (isset($categoryId)) {
			$this->set('categoryId', $categoryId);
		}
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
	 * TRPGシステム詳細の表示。
	 *
	 * @param unknown $id ID
	 */
	public function view($id) {

		// ソート、カテゴリの引き継ぎ
		if (isset($this->request->query['sort'])) {
			$this->set('sort', $this->request->query['sort']);
		}
		if (isset($this->request->query['category_id'])) {
			$this->set('categoryId', $this->request->query['category_id']);
		}

		// TRPGシステム詳細の取得
		$this->getTrpgSystem($id);

		// TRPGレビュー一覧の取得
		$this->getTrpgReviews($id);
	}

	/**
	 * TRPGシステム詳細の取得
	 */
	protected function getTrpgSystem($id) {
		$trpgSystem = $this->TrpgSystem->findById($id);
		$this->set('trpgSystem', $trpgSystem);
	}

	/**
	 * TRPGレビュー一覧の取得
	 */
	protected function getTrpgReviews($id) {
		$this->paginate = array(
				'TrpgReview' => array(
					'order' => array('TrpgReview.modified' => 'DESC'),
					'limit' => 10,
					'conditions' => array('TrpgReview.trpg_system_id' => $id),
				)
		);
		$this->set('trpgReviews', $this->paginate('TrpgReview'));
	}
}
