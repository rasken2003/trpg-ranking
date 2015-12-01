<?php
/**
 * TRPGレビューのコントローラー。
 *
 * @author Hidemasa Aoki
 */
class TrpgReviewsController extends AppController {

	/**
	 * TRPG共通コンポーネント。
	 */
	public $components = array('TrpgCommon');

	/**
	 * TRPGレビュー詳細の表示。
	 *
	 * @param unknown $id ID
	 */
	public function view($id) {

		// ソート、カテゴリの引き継ぎ
		$this->TrpgCommon->transferSortAndCategoryCondition($this);

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
