<?php
/**
 * ユーザのコントローラー。
 *
 * @author Hidemasa Aoki
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::import('Vendor','facebook',array('file' => 'facebook/src/facebook.php'));
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
		$this->Auth->allow('twitter_login', 'twitter_oauth_callback', 'facebook');
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
	 * ユーザ変更。
	 */
	public function edit() {

		// POSTされたときのみ処理する。
		// ユーザ情報を変更する。
		if ($this->request->is('post')) {
			$data['User']['id'] = $this->request->data['User']['id'];
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
				$this->Auth->login($result['User']);
				$this->Session->setFlash('ユーザ情報を変更しました。');
				return $this->redirect('/home');
			} else {
				$this->set('message', '変更に失敗しました。<br>');
				$this->render('/Errors/message');
				return;
			}
		}
		// POSTではなかったときは、ユーザ情報を取得する。
		else {
			$result = $this->User->findById($this->Auth->user('id'));
			$result['User']['password'] = '';
			$this->request->data = $result;
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

	/**
	 * Facebookログイン＆コールバック。
	 */
	public function facebook(){

		// App IDとApp Secretを取得。
		$this->facebook = $this->createFacebook();

		// ユーザ情報
		$user = $this->facebook->getUser();

		// 認証後（コールバック）
		if ($user) {

			// ユーザ情報を取得
			$me = $this->facebook->api('/me','GET',array('locale'=>'ja_JP'));

			// ユーザ登録
			$data = $this->facebook_signin($me);

			// CakePHPのAuthログイン処理
			$this->Auth->login($data);

			// ログイン後画面へリダイレクト
			return $this->redirect($this->Auth->redirect());
		}
		// 認証前（Facebookログインへ飛ぶ）
		else {
			$url = $this->facebook->getLoginUrl(array(
			'scope' => 'email,publish_stream,user_birthday','canvas' => 1,'fbconnect' => 0));
			return $this->redirect($url);
		}
	}

	/**
	 * App IDとApp Secretを返却。
	 *
	 * @return Facebook
	 */
	protected function createFacebook() {
		return new Facebook(array(
			'appId' => '1657673334472005',
			'secret' => '8a7c8c0d664cdb0a55cc3c93a0e4c05a'
		));
	}

	/**
	 * Facebookユーザ登録。
	 */
	protected function facebook_signin($me) {

		// 入力チェックの設定
		$this->User->$validate = array(
				'username' => array(
						'rule' => 'isUnique',
						'message' => '重複です'
				),
		);

		// データ編集
		$data['User']['username'] = $me['id'];
		$data['User']['nickname'] = $me['name'];
		$data['User']['password'] = '';

		//バリデーションチェックでエラーがなければ、新規登録
		if ($this->User->validates()) {
			$this->User->save($data);
		}

		// ユーザ情報を返却
		return $data;
	}
}
