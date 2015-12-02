<?php
/**
 * トップページのコントローラー。
 *
 * @author Hidemasa Aoki
 */
class HomeController extends AppController {

	/**
	 * モデル：TRPGシステム。
	 */
	public $uses = array('News', 'TrpgSystem');

	/**
	 * TRPG共通コンポーネント。
	 */
	public $components = array('TrpgCommon');

	/**
	 * 初期表示。
	 */
	public function index() {

		// ソート、カテゴリの引き継ぎ
		$this->TrpgCommon->transferSortAndCategoryCondition($this);

		// ニュース一覧の取得
		$this->getNews();

		// TRPGシステム一覧の取得
		$this->getTrpgSystems();
	}

	/**
	 * ニュース一覧の取得。
	 */
	protected function getNews() {
		$options = array(
				'order' => array('News.delivery_time DESC', 'News.modified DESC'),
				'limit' => 10,
		);
		$this->set('news', $this->News->find('all', $options));
	}

	/**
	 * TRPGシステム一覧の取得。
	 */
	protected function getTrpgSystems() {
		$options = array(
				'order' => array('TrpgSystem.rank ASC', 'TrpgSystem.modified DESC'),
				'limit' => 5,
		);
		$this->set('trpgSystems', $this->TrpgSystem->find('all', $options));
	}
}
