<?php
/**
 * 仮ユーザのコントローラー。
 *
 * @author Hidemasa Aoki
 */
App::uses('CakeEmail', 'Network/Email');
class TmpUsersController extends AppController {

	/**
	 * 初期表示とメール送信。
	 */
	public function regist() {

		// バリデーションのセット
		$this->TmpUser->validate = array(
				'email' => array(
						array(
								'rule' => array('email'),
								'message' => 'メールアドレスを入力してください。'
						)
				),
				'captcha' => array(
						array(
								'rule' => array('checkCaptcha'),
								'message' => '正しく入力してください。'
						)
				),
		);

		// POSTされた時のみ、処理する。
		if ($this->request->is('post')) {

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
				$result = $this->TmpUser->save(array(), array('validate' => false));

				// 認証コードを作成
				$activateCode = $this->TmpUser->getActivationHash();

				// 認証メールを作成し、送信
				$this->sendActivationMail($activateCode);

				// 認証コードを保存
				$this->TmpUser->saveField('activate_code', $activateCode);

				// 認証メール送信成功画面に遷移
				$this->render("success");
				return;
			}
		}
	}

	/**
	 * 認証メールを作成し、送信。
	 */
	protected function sendActivationMail($activateCode) {

		// URL作成
		$url =
			'/'.'users'.						// コントローラ
			'/'.'activate'.					// アクション
			'/'.$this->TmpUser->id.			// ユーザID
			'/'.$activateCode;				// ハッシュ値
		$url = Router::url($url, true);		// ドメイン(+サブディレクトリ)を付与

		// メール送信
		$email = new CakeEmail('default');
		$email->to($this->request->data['TmpUser']['email']);
		$email->subject('【TRPGランキング】登録認証メール');
		$email->template('activation_mail');
		$email->viewVars(array('url' => $url));
		$email->send();
	}

	/**
	 * 画像作成。
	 */
	public function captcha() {
		App::import('Vendor', 'Securimage', array('file' => 'securimage/securimage.php'));
		$securimage = new Securimage();
		$securimage->ttf_file = ROOT.'/vendors/securimage/AHGBold.ttf';
		$securimage->show();
	}
}
