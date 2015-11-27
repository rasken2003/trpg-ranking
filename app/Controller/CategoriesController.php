<?php
/**
 * カテゴリのコントローラー。
 *
 * @author Hidemasa Aoki
 */
class CategoriesController extends AppController {

	/**
	 * カテゴリ一覧の取得。
	 */
	public function getList() {
		$list = $this->Category->find('all',
				array(
						'order' => array('id ASC')
				)
		);
		return $list;
	}
}
