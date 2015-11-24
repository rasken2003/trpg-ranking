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
}
