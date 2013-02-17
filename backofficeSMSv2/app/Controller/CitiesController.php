<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 */
class CitiesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
    	$this->Auth->allow('get_from_state');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->City->recursive = 0;
		$this->set('cities', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->City->id = $id;
		if (!$this->City->exists()) {
			throw new NotFoundException(__('Invalid city'));
		}
		$this->set('city', $this->City->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->City->create();
			if ($this->City->save($this->request->data)) {
				$this->Session->setFlash(__('The city has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.'));
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
		$this->City->id = $id;
		if (!$this->City->exists()) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->City->save($this->request->data)) {
				$this->Session->setFlash(__('The city has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->City->read(null, $id);
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
		$this->City->id = $id;
		if (!$this->City->exists()) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->City->delete()) {
			$this->Session->setFlash(__('City deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('City was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * Returns the cities from the specified state.
 * 
 * @return JSON object
 */
	public function get_from_state($stateId, $city = null) {
		$this->layout = 'ajax';
		$this->autoRender = false;
		if ($city != null) {
			$citiesResult = $this->City->find('all', array('conditions' => array('City.idstate' => $stateId, 'City.name REGEXP' => '^'.$city)));
		}			
		else {
			$citiesResult = $this->City->find('all', array('conditions' => array('City.idstate' => $stateId)));
		}
		$cities = array();
		if ($city != null) {
			foreach($citiesResult as $city) {
				$cities[$city['City']['name']] = $city['City']['name'];
			}
		}
		else {
			foreach($citiesResult as $city) {
				$cities[$city['City']['name']] = $city['City']['name'];
			}
		}
		echo json_encode($cities);
	}
	
}
