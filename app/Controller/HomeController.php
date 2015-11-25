<?php
/**
 * トップページのコントローラー
 *
 * @author Hidemasa Aoki
 */
class HomeController extends AppController {

	/**
	 * モデル：TRPGシステム
	 */
	public $uses = array('News', 'TrpgSystem');

	/**
	 * 初期表示
	 */
	public function index() {

		// ニュース一覧の取得
		$this->set('news', $this->getNews());

		// TRPGシステム一覧の取得
		$this->set('trpgSystems', $this->getTrpgSystems());
	}

	/**
	 * 画像取得
	 *
	 * @param unknown $id ID
	 */
	public function image($id) {
		$trpgSystem = $this->TrpgSystem->findById($id);
		echo $trpgSystem['TrpgSystem']['image'];
	}

	/**
	 * TRPGシステム一覧の取得
	 */
	protected function getTrpgSystems() {
		$options = array(
				'order' => array('TrpgSystem.rank ASC', 'TrpgSystem.modified ASC'),
				'limit' => 5,
		);
		return $this->TrpgSystem->find('all', $options);
	}

	/**
	 * ニュース一覧の取得
	 */
	protected function getNews() {
		$options = array(
				'order' => array('News.delivery_time DESC', 'News.modified DESC'),
				'limit' => 10,
		);
		return $this->News->find('all', $options);
	}
}
