<?php
App::uses('AppController', 'Controller');
/**
 * Prizes Controller
 *
 * @property Prize $Prize
 */
class PrizesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Prize->recursive = 0;
		$this->set('prizes', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Prize->id = $id;
		if (!$this->Prize->exists()) {
			throw new NotFoundException(__('Invalid prize'));
		}
		$this->set('prize', $this->Prize->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Prize->create();
			if ($this->Prize->save($this->request->data)) {
				$this->Session->setFlash(__('The prize has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prize could not be saved. Please, try again.'));
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
		$this->Prize->id = $id;
		if (!$this->Prize->exists()) {
			throw new NotFoundException(__('Invalid prize'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Prize->save($this->request->data)) {
				$this->Session->setFlash(__('The prize has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prize could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Prize->read(null, $id);
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
		$this->Prize->id = $id;
		if (!$this->Prize->exists()) {
			throw new NotFoundException(__('Invalid prize'));
		}
		if ($this->Prize->delete()) {
			$this->Session->setFlash(__('Prize deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Prize was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
