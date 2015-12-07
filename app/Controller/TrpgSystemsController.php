<?php
/**
 * TRPGシステムのコントローラー。
 *
 * @author Hidemasa Aoki
 */
class TrpgSystemsController extends AppController {

	/**
	 * TRPGシステムモデル、TRPGレビューモデル。
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

		// ソート
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

		// カテゴリID
		if (isset($this->request->query['category_id'])) {
			$categoryId = $this->request->query['category_id'];
			$conditions['TrpgSystem.category_id'] = $categoryId;
		}

		// 検索キーワード
		if (isset($this->request->query['search_keyword'])) {
			$searchKeyword = $this->request->query['search_keyword'];
			$conditions['or'] = array(
					'TrpgSystem.title like' => '%'.$searchKeyword.'%',
					'TrpgSystem.contents like' => '%'.$searchKeyword.'%',
			);
			$this->request->data['TrpgSystems']['search_keyword'] = $searchKeyword;
		}

		// サブタイトルのセット
		if (isset($subTitle)) {
			$this->set("subTitle", $subTitle);
		}

		// 検索条件の設定
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

		// 検索して、設定
		$this->set('trpgSystems', $this->paginate('TrpgSystem'));
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
