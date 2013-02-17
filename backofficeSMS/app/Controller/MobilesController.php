<?php
App::uses('AppController', 'Controller', 'Datasource');
/**
 * Mobiles Controller
 *
 * @property Mobile $Mobile
 */
class MobilesController extends AppController {

	public function beforeFilter() {
	    parent::beforeFilter();
		$this->Auth->allow('won_list');
		$this->Auth->allow('confirm');
		$this->Auth->allow('confirmed_list');
	}


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Mobile->recursive = 0;
		$this->set('mobiles', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Mobile->id = $id;
		if (!$this->Mobile->exists()) {
			throw new NotFoundException(__('Invalid mobile'));
		}
		$this->set('mobile', $this->Mobile->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Mobile->create();
			if ($this->Mobile->save($this->request->data)) {
				$this->Session->setFlash(__('The mobile has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mobile could not be saved. Please, try again.'));
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
		$this->Mobile->id = $id;
		if (!$this->Mobile->exists()) {
			throw new NotFoundException(__('Invalid mobile'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Mobile->save($this->request->data)) {
				$this->Session->setFlash(__('The mobile has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mobile could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Mobile->read(null, $id);
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
		$this->Mobile->id = $id;
		if (!$this->Mobile->exists()) {
			throw new NotFoundException(__('Invalid mobile'));
		}
		if ($this->Mobile->delete()) {
			$this->Session->setFlash(__('Mobile deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Mobile was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * List all the mobile phones that need to be confirmed
 * 
 * @return void
 */
	public function won_list() {
		$operator = $this->Session->read('Auth.User');
		$wonMobilesList = $this->Mobile->find('all', array('conditions' => array('Mobile.status' => 'won'),
															'order' => array('Mobile.dateupdated' => 'asc')));
		$count = 0;
		foreach($wonMobilesList as $m) {
			$wonMobilesList[$count]['Mobile']['mobile'] = $this->Mobile->get_normal($m['Mobile']['mobile']);
			$count = $count + 1;
		}
		$this->set('wonMobilesList', $wonMobilesList);
	}
	
/**
 * Confirms the winner of a mobile phone by
 * completing the information (name, last name, id-card number).
 *
 * @param string $id
 * @return void
 */
	public function confirm($id = null) {
		$this->loadModel('Region');
		$this->loadModel('Store');
		$this->Mobile->id = $id;
		if (!$this->Mobile->exists()) {
			throw new NotFoundException(__('Invalid mobile'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$operator = $this->Session->read('Auth.User');
			$mobile = $this->Mobile->read(null, $id);
			$mobileOperator = $this->request->data['Mobile']['operator'];
			$mobileNumber = $this->request->data['Mobile']['mobile2'];
			$this->request->data['Mobile']['id'] = $id;
			$this->request->data['Mobile']['confirmedby'] = $operator['username'];
			$this->request->data['Mobile']['mobile'] = $mobile['Mobile']['mobile'];
			$this->request->data['Mobile']['mobile2'] = $mobileOperator + $mobileNumber;
			$this->request->data['Mobile']['status'] = 'confirmed';
			$this->request->data['Mobile']['dateconfirmed'] = DboSource::expression('NOW()');
			unset($this->request->data['Mobile']['region']);
			unset($this->request->data['Mobile']['city']);
			unset($this->request->data['Mobile']['operator']);
			if ($this->Mobile->save($this->request->data)) {
				$this->Session->setFlash(__('El teléfono fue confirmado de forma satisfactoria'));
				$this->redirect(array('action' => 'won_list'));
		 	} else {
				$this->Session->setFlash(__('El celular no pudo ser confirmado. Intente de nuevo.'));
				$mobileNormal = $this->Mobile->get_normal($this->request->data['Mobile']['mobile']);
				$this->set('mobileNormal', $mobileNormal);
				$regionsResult = $this->Region->find('all', array('order'=>'Region.name ASC'));
				$regions = array();
				$regions[0] = "";
				foreach($regionsResult as $r) {
					$regions[$r['Region']['id']] = $r['Region']['name'];
				}
				$this->set('regions', $regions);
				$this->request->data['Mobile']['operator'] = $mobileOperator;
				$this->request->data['Mobile']['mobile2'] = $mobileNumber;
			}
		} else {
			$this->request->data = $this->Mobile->read(null, $id);
			$mobileNormal = $this->Mobile->get_normal($this->request->data['Mobile']['mobile']); 
			$regionsResult = $this->Region->find('all', array('order'=>'Region.name ASC'));
			$regions = array();
			$regions[0] = "Selecciona una región";
			foreach($regionsResult as $r) {
				$regions[$r['Region']['id']] = $r['Region']['name'];
			}
			$this->set('regions', $regions);
			$this->set('mobileNormal', $mobileNormal);
		}
	}

/**
 * List all the mobile phones that have been confirmed
 * 
 * @param	store	the store checking in
 * @return	void
 */
	public function confirmed_list($mobileId = NULL) {
		if ($mobileId != NULL) {
			$this->request->data = $this->Mobile->read(null, $mobileId);
			if ($this->request->data['Mobile']['status'] == 'confirmed') {
				$this->request->data['Mobile']['status'] = 'given';
				$this->request->data['Mobile']['dategiven'] = DboSource::expression('NOW()');
				$this->Mobile->save($this->request->data);
				$this->Session->setFlash(__('El teléfono fue entregado de forma satisfactoria'));
				$this->redirect(array('action' => 'confirmed_list'));
			}
		}
		$operator = $this->Session->read('Auth.User');
		$confirmedMobilesList = $this->Mobile->find('all', array('conditions' => array('Mobile.status' => 'confirmed', 'Mobile.store' => $operator['username']),
														'order' => array('Mobile.dateupdated' => 'asc')));
		$count = 0;
		foreach($confirmedMobilesList as $m) {
			$confirmedMobilesList[$count]['Mobile']['mobile'] = $this->Mobile->get_normal($m['Mobile']['mobile']);
			$count = $count + 1;
		}
		$this->set('confirmedMobilesList', $confirmedMobilesList);
	}

}
