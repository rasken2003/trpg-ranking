<?php
/**
 * 仮ユーザのコントローラー。
 *
 * @author Hidemasa Aoki
 */
class TmpUsersController extends AppController {

	/**
	 * 初期表示とメール送信。
	 */
	public function regist() {

		// POSTされた時のみ、処理する。
		if ($this->request->is('post')) {

			// バリデーションのセット
			$this->TmpUser->validate = array(
					'email' => array(
							array(
								'rule' => array('email'),
								'message' => 'メールアドレスを入力してください。'
							)
					)
			);

			// バリデーションの実行
			$this->TmpUser->set($this->request->data);
			$errors = $this->TmpUser->invalidFields();

			// エラーがあるかどうか
			if (count($errors) > 0) {

				// エラーがあるときは、そのまま戻る。
				return;
			} else {

				// エラーがないとき

				// 仮ユーザにいったん登録
				$result = $this->TmpUser->save();

				// 認証コードを作成
				$activationCode = $this->TmpUser->getActivationHash();

				// 認証メールを作成し、送信

				// 認証コードを保存
				$this->TmpUser->saveField('activate_code', $activationCode);

				// 認証メール送信成功画面に遷移
				$this->render("success");
				return;
			}
		}
	}
}
