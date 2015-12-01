<?php
/**
 * TRPG共通のコンポーネント。
 *
 * @author Hidemasa Aoki
 */
class TrpgCommonComponent extends Component {

	/**
	 * ソート、カテゴリを引き継ぐ。
	 */
	public function transferSortAndCategoryCondition($controller) {
		if (isset($controller->request->query['sort'])) {
			$sort = $controller->request->query['sort'];
			$controller->set('sort', $sort);
			$controller->set('sortCond', 'sort='.$sort);
		} else {
			$controller->set('sort', '');
			$controller->set('sortCond', '');
		}
		if (isset($controller->request->query['category_id'])) {
			$categoryId = $controller->request->query['category_id'];
			$controller->set('categoryId', $categoryId);
			$controller->set('categoryIdCond', 'category_id='.$categoryId);
		} else {
			$controller->set('categoryId', '');
			$controller->set('categoryIdCond', '');
		}
	}
}