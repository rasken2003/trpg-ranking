<?php
/**
 * TRPGレビューのコントローラー。
 *
 * @author Hidemasa Aoki
 */
class TrpgReviewsController extends AppController {

	/**
	 * コンポーネント：Auth。
	 */
	public $components = array('Auth', 'Security');

	/**
	 * beforeFilter。
	 */
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
		$this->Auth->deny('update');
	}

	/**
	 * TRPGレビュー詳細の表示。
	 *
	 * @param unknown $id ID
	 */
	public function view($id) {

		// TRPGレビュー詳細の取得
		$this->getTrpgReview($id);
	}

	/**
	 * TRPGレビュー詳細の取得
	 */
	protected function getTrpgReview($id) {
		$trpgReview = $this->TrpgReview->findById($id);
		$this->set('trpgReview', $trpgReview);
	}

	/**
	 * TRPGレビューの更新。
	 */
	public function update($trpgSystemId = null) {

		// POSTされたときは、データ更新を試みる。
		if ($this->request->is('post')) {
			if (!isset($this->request->data['TrpgReview']['id'])) {
				$this->TrpgReview->create();
			}
			$data['TrpgReview']['id'] = $this->request->data['TrpgReview']['id'];
			$data['TrpgReview']['trpg_system_id'] = $this->request->data['TrpgReview']['trpg_system_id'];
			$data['TrpgReview']['title'] = $this->request->data['TrpgReview']['title'];
			$data['TrpgReview']['evaluation_value'] = $this->request->data['TrpgReview']['evaluation_value'];
			$data['TrpgReview']['contents'] = $this->request->data['TrpgReview']['contents'];
			$data['TrpgReview']['reviewer_user_id'] = $this->Auth->user('id');
			$this->TrpgReview->set($data);
			$errors = $this->TrpgReview->invalidFields();
			if (count($errors) > 0) {
				return;
			}
			$result = $this->TrpgReview->save($data);
 			if ($result) {
 				if (!$this->is_empty($this->request->data['TrpgReview']['sort'])) {
 					$sortCond = 'sort='.$this->request->data['TrpgReview']['sort'];
 				} else {
 					$sortCond = '';
 				}
 				if (!$this->is_empty($this->request->data['TrpgReview']['category_id'])) {
 					$categoryIdCond = 'category_id='.$this->request->data['TrpgReview']['category_id'];
 				} else {
 					$categoryIdCond = '';
  				}
 				$this->Session->setFlash('レビューを投稿、更新しました。');
				$this->redirect('/trpg_systems/view/'.$this->request->data['TrpgReview']['trpg_system_id'].'?'.$sortCond.'&'.$categoryIdCond);
				return;
  			} else {
				$this->set('message', '登録に失敗しました。<br>');
				$this->render('/Errors/message');
				return;
  			}
		}
		// そうでないときは、データ取得を試みる。
		else {
			$options = array(
					'order' => array('TrpgReview.modified' => 'DESC'),
					'conditions' => array(
							'TrpgReview.trpg_system_id' => $trpgSystemId,
							'TrpgReview.reviewer_user_id' => $this->Auth->user('id'),
					),
			);
			$trpgReview = $this->TrpgReview->find('first', $options);
			if (!$trpgReview) {
				$trpgReview['TrpgReview']['trpg_system_id'] = $trpgSystemId;
			}
			if (isset($this->request->query['sort'])) {
				$trpgReview['TrpgReview']['sort'] = $this->request->query['sort'];
			} else {
				$trpgReview['TrpgReview']['sort'] = '';
			}
			if (isset($this->request->query['category_id'])) {
				$trpgReview['TrpgReview']['category_id'] = $this->request->query['category_id'];
			} else {
				$trpgReview['TrpgReview']['category_id'] = '';
			}
			$this->request->data = $trpgReview;
		}
	}

	/**
	 * 空かどうか。
	 * @param unknown $var 値
	 */
	protected function is_empty($var) {
		if (isset($var) && $var != '') {
			return false;
		} else {
			return true;
		}
	}
}
