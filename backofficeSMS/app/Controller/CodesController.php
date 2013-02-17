<?php
App::uses('AppController', 'Controller');
/**
 * Codes Controller
 *
 * @property Code $Code
 */
class CodesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
    	$this->Auth->allow('equilibrio');
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Code->recursive = 0;
		$this->set('codes', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Code->id = $id;
		if (!$this->Code->exists()) {
			throw new NotFoundException(__('Invalid code'));
		}
		$this->set('code', $this->Code->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Code->create();
			if ($this->Code->save($this->request->data)) {
				$this->Session->setFlash(__('The code has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The code could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Code->id = $id;
		if (!$this->Code->exists()) {
			throw new NotFoundException(__('Invalid code'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Code->save($this->request->data)) {
				$this->Session->setFlash(__('The code has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The code could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Code->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Code->id = $id;
		if (!$this->Code->exists()) {
			throw new NotFoundException(__('Invalid code'));
		}
		if ($this->Code->delete()) {
			$this->Session->setFlash(__('Code deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Code was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	

/**
 * Function for delivering 3 new codes the codes to Equilibrio.net
 * special promotion day
 */
 	public function equilibrio() {
 		$this->layout = 'ajax';
		$this->autoRender = false;
 		$codes = $this->Code->find('all', array('conditions'=>array('equilibrio'=>0),'limit' => 3));
		$eqCodes = array();
		
		for($i = 0; $i < count($codes); $i++) {
			$codes[$i]['Code']['equilibrio']++;
			$this->Code->save($codes[$i]);
			$eqCodes[$i] = $codes[$i]['Code']['code'];
		}
		echo json_encode($eqCodes);
 	}
}
