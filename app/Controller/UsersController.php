<?php
/**
 * ユーザのコントローラー。
 *
 * @author Hidemasa Aoki
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class UsersController extends AppController {

	/**
	 * モデル：仮ユーザ、ユーザ。
	 */
	public $uses = array('TmpUser', 'User');

	/**
	 * コンポーネント：Auth、TwitterKit。
	 */
	public $components = array('Auth', 'TwitterKit.Twitter');

	/**
	 * beforeFilter。
	 * @see Controller::beforeFilter()
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('twitter_login', 'twitter_oauth_callback');
	}

	/**
	 * 認証。
	 */
	public function activate($id, $activateCode) {

		// 仮ユーザテーブルにあるかどうか
		$options = array(
				'conditions' => array(
					'TmpUser.id' => $id,
					'TmpUser.activate_code' => $activateCode
				)
		);
		$tmpUser = $this->TmpUser->find('first', $options);

		// データが見つからない場合は認証エラーへ
		if ($tmpUser == false) {
			$this->set('message', '認証に失敗しました。<br>');
			$this->render('/Errors/message');
			return;
		}
		// 見つかった場合は、認証成功なので、仮ユーザIDをセッションに保管後、
		// ユーザ登録へ
		else {
			$this->Session->write('tmpUserId', $id);
			$this->render('add');
			return;
		}
	}

	/**
	 * ユーザ登録。
	 */
	public function add() {

		// POSTされたときのみ処理する。
		// 登録に成功したら、仮ユーザから削除し、仮ユーザIDをセッションから削除
		if ($this->request->is('post')) {
			$this->User->create();
			$data['User']['username'] = $this->request->data['User']['username'];
			$data['User']['nickname'] = $this->request->data['User']['nickname'];
			$data['User']['password'] = $this->request->data['User']['password'];
			$data['User']['password_confirm'] = $this->request->data['User']['password_confirm'];
			$this->User->set($data);
			$errors = $this->User->invalidFields();
			if (count($errors) > 0) {
				return;
			}
			$passwordHasher = new SimplePasswordHasher();
			$data['User']['password'] = $passwordHasher->hash($data['User']['password']);
			$result = $this->User->save($data, array('validate' => false));
			if ($result) {
				$tmpUserId = $this->Session->read('tmpUserId');
				$this->TmpUser->delete($tmpUserId);
				$this->Session->delete('tmpUserId');
				$this->render('success');
				return;
			} else {
				$this->set('message', '登録に失敗しました。<br>');
				$this->render('/Errors/message');
				return;
			}
		}
		// POSTではなかったときは、アクセスエラーにする。
		else {
			$this->set('message', '不正なアクセスです。<br>');
			$this->render('/Errors/message');
			return;
		}
	}

	/**
	 * ログイン。
	 */
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash('ログインに失敗しました。');
			}
		}
	}

	/**
	 * ログアウト。
	 */
	public function logout() {
		$this->Auth->logout();
		return $this->redirect('/home');
	}

	/**
	 * Twitterログイン。
	 */
	public function twitter_login() {
		$this->Twitter->setTwitterSource('twitter');
		return $this->redirect($this->Twitter->getAuthenticateUrl(null, true));
	}

	/**
	 * Twitterコールバック。
	 */
	public function twitter_oauth_callback() {

		// 認証が実施されずにリダイレクト先から遷移してきた場合の処理
		if(!$this->Twitter->isRequested()) {
			$this->flash(__('invalid access.'), '/', 5);
			return;
		}

		// アクセストークンの取得を実施
		$this->Twitter->setTwitterSource('twitter');
		$token = $this->Twitter->getAccessToken();

		// ユーザ登録
		$data = $this->twitter_signin($token);

		// CakePHPのAuthログイン処理
		$this->Auth->login($data);

		// ログイン後画面へリダイレクト
		return $this->redirect($this->Auth->redirect());
	}

	/**
	 * Twitterユーザ登録。
	 */
	protected function twitter_signin($token) {

		// 入力チェックの設定
		$this->User->$validate = array(
				'username' => array(
						'rule' => 'isUnique',
						'message' => '重複です'
				),
		);

		//アクセストークンを正しく取得できなかった場合はエラー
		if (is_string($token)) {
			return;
		}

		// データ編集
		$data['User']['username'] = $token['user_id'];
		$data['User']['nickname'] = $token['screen_name'];
		$data['User']['password'] = Security::hash($token['oauth_token']);

		//バリデーションチェックでエラーがなければ、新規登録
		if ($this->User->validates()) {
			$this->User->save($data);
		}

		// ユーザ情報を返却
		return $data;
	}
}
