<?php
App::uses('AppController', 'Controller');
/**
 * Stores Controller
 *
 * @property Store $Store
 */
class StoresController extends AppController {
	
	
  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('get_from_city');
	$this->Auth->allow('get_cities_from_region');
  }
  
  public function isAuthorized($user) {
    //if (isset($user['role']) && $user['role'] === 'stats' && $this->action === 'stats') {
    // return true;
    //}

    //if ((isset($user['role']) && $user['role'] === 'operator') && $this->action === 'main') {
    //  return true;
    //}
	
	//if ((isset($user['role']) && $user['role'] === 'stats') && $this->action === 'main') {
    //  return true;
    //}

    return parent::isAuthorized($user);
  }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Store->recursive = 0;
		$this->set('stores', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Store->id = $id;
		if (!$this->Store->exists()) {
			throw new NotFoundException(__('Invalid store'));
		}
		$this->set('store', $this->Store->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		// TODO: 	load States and City models
		$this->loadModel('State');
		$statesResult = $this->State->find('all', array('order'=>'State.ord'));
		$states;
		$states[0] = "";
		foreach($statesResult as $s) {
			$stateid = $s['State']['id'];
			$states[$stateid] = $s['State']['name'];
		}
		$this->set('venezuelaStates', $states);
		if ($this->request->is('post')) {
			$this->loadModel('User');
			// TODO:	validate
			$samePassword = $this->request->data['Store']['password'] == $this->request->data['Store']['password2'];
			$this->request->data['User']['username'] = $this->request->data['Store']['username'];
			$this->request->data['User']['password'] = $this->request->data['Store']['password'];
			$this->request->data['User']['name'] = $this->request->data['Store']['name'];
			$this->request->data['User']['profile'] = 'store';
			$this->Store->create();
			if ($this->Store->save($this->request->data)) {
				$this->Session->setFlash(__('The store has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The store could not be saved. Please, try again.'));
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
		$this->Store->id = $id;
		if (!$this->Store->exists()) {
			throw new NotFoundException(__('Invalid store'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Store->save($this->request->data)) {
				$this->Session->setFlash(__('The store has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The store could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Store->read(null, $id);
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
		$this->Store->id = $id;
		if (!$this->Store->exists()) {
			throw new NotFoundException(__('Invalid store'));
		}
		if ($this->Store->delete()) {
			$this->Session->setFlash(__('Store deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Store was not deleted'));
		$this->redirect(array('action' => 'index'));
	}



/**
 * Retrieve the cities from a given region in order to
 * feed the select box in the mobile confirmation form.
 * 
 * @return JSON object
 */
	public function get_cities_from_region($region = null) {
		$this->layout = 'ajax';
		$this->autoRender = false;
		if ($region != null) {
			$citiesResult = $this->Store->find('all', array('conditions' => array('Store.region'=> $region), 'group' => 'Store.city'));
			$cities = array();
			foreach($citiesResult as $c) {
				$city = $c['Store']['city'];
				$cities[$city] = $city;
			}
			echo json_encode($cities);
		}
	}

/**
 * Returns the stores from the specified city.
 * 
 * @return JSON object
 */
	public function get_from_city($city = null) {
		$this->layout = 'ajax';
		$this->autoRender = false;
		if ($city != null) {
			$storesResult = $this->Store->find('all', array('conditions' => array('Store.city' => $city)));
			$stores = array();
			$x = 0;
			foreach($storesResult as $s) {
				$stores[$x] = array('id' => $s['Store']['id'],
								'name' => $s['Store']['name'],
								'username' => $s['Store']['username'],
								'address' => $s['Store']['address'],
								'officehours' => $s['Store']['officehours']);
				$x++;
			}
			echo json_encode($stores);
		}
	}
}
