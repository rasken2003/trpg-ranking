<?php
/**
 * TRPGレビューのコントローラー。
 *
 * @author Hidemasa Aoki
 */
class TrpgReviewsController extends AppController {

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
}
