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
	 * コンポーネント：セッション。
	 */
	public $components = array('Session');

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
}
