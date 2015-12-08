<?php
class TmpUser extends AppModel {

	/**
	 * 認証コードの取得。
	 */
	public function getActivationHash() {

		// ユーザIDの有無確認
		if (!isset($this->id)) {
			return false;
		}

		// 更新日時をハッシュ化
		return Security::hash($this->field('modified'), 'md5', true);
	}

	/**
	 * キャプチャコードチェック。
	 */
	public function checkCaptcha($check) {
		App::import('Vendor', 'Securimage', array('file' => 'securimage/securimage.php'));
		$securimage = new Securimage();
		foreach ($check as $key => $value) {
			if ($securimage->check($value) === false) {
				return false;
			}
		}
		return true;
	}
}
