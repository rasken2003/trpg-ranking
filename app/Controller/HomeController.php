<?php
class HomeController extends AppController {
	public $uses = array('TrpgSystem');
	public function index() {
		$options = array(
				'order' => array('TrpgSystem.rank ASC', 'TrpgSystem.modified ASC'),
				'limit' => 10,
		);
		$trpgSystems = $this->TrpgSystem->find('all', $options);
		$this->set('trpgSystems', $trpgSystems);
	}

	public function image($id) {
		$trpgSystem = $this->TrpgSystem->findById($id);
		echo $trpgSystem['TrpgSystem']['image'];
	}
}
