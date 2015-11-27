<?php
/**
 * ニュースのコントローラー。
 *
 * @author Hidemasa Aoki
 */
class NewsController extends AppController {

	/**
	 * 初期表示。
	 */
	public function index() {

		// ニュース一覧の取得
		$this->getNews();
	}

	/**
	 * ニュース一覧の取得。
	 */
	protected function getNews() {
		$this->paginate = array(
				'News' => array(
					'order' => array('News.delivery_time' => 'DESC', 'News.modified' => 'DESC'),
					'limit' => 10,
				)
		);
		$this->set('news', $this->paginate('News'));
	}

	/**
	 * ニュース詳細の取得。
	 *
	 * @param unknown $id ID
	 */
	public function view($id) {
		$newsRec = $this->News->findById($id);
		$this->set('newsRec', $newsRec);
	}
}
