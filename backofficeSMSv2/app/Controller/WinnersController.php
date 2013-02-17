<?php
App::uses('AppController', 'Controller');
/**
 * Winners Controller
 *
 * @property Winner $Winner
 */
class WinnersController extends AppController {

/**
 * Grants global permission to some controller functions.
 * @param void
 * @return void
 */
  public function beforeFilter() {
    parent::beforeFilter();
  }
  
/**
 * Grants permissions to controller's function given the user's role
 * and the action the user has called.
 * @param	object		$user
 * @return	bool
 */
  public function isAuthorized($user) {
    if (isset($user['role']) && $user['role'] === 'operator' && $this->action === 'index') {
      return true;
    }
	
	if (isset($user['role']) && $user['role'] === 'operator' && $this->action === 'edit') {
      return true;
    }
	
	if (isset($user['role']) && $user['role'] === 'contact' && $this->action === 'index') {
      return true;
    }
	
	if (isset($user['role']) && $user['role'] === 'contact' && $this->action === 'edit') {
      return true;
    }

    return parent::isAuthorized($user);
  }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Winner->recursive = 0;
		$this->set('winners', $this->paginate());
		$pending = $this->Winner->find('all', array('conditions' => array('Winner.status' => 'pending')));
		$rejected = $this->Winner->find('all', array('conditions' => array('Winner.status' => 'rejected')));
		$contacted = $this->Winner->find('all', array('conditions' => array('Winner.status' => 'contacted')));
		$scheduled = $this->Winner->find('all', array('conditions' => array('Winner.status' => 'scheduled')));
		$backup = $this->Winner->find('all', array('conditions' => array('Winner.status' => 'backup')));
		$this->set('pending', $pending);
		$this->set('rejected', $rejected);
		$this->set('contacted', $contacted);
		$this->set('scheduled', $scheduled);
		$this->set('backup', $backup);
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Winner->id = $id;
		if (!$this->Winner->exists()) {
			throw new NotFoundException(__('Invalid winner'));
		}
		$this->set('winner', $this->Winner->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Winner->create();
			if ($this->Winner->save($this->request->data)) {
				$this->Session->setFlash(__('The winner has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The winner could not be saved. Please, try again.'));
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
		$this->loadModel('State');
		$this->Winner->id = $id;
		$everythingOk = false;
		if (!$this->Winner->exists()) {
			throw new NotFoundException(__('Registro invalido'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$tmpPrize = $this->request->data['Winner']['prize'];
			if ($this->request->data['Winner']['status'] == 'rejected') {
				$this->request->data['Winner']['prize'] = "RECHAZADO - " . $this->request->data['Winner']['prize'];
			}
			if ($this->Winner->save($this->request->data)) {
				$this->Session->setFlash(__('Ganador modificado exitosamente.'));
				$everythingOk = true;
			} 
			if ($this->request->data['Winner']['status'] == 'rejected') {
				$newWinner = $this->Winner->find('first', array('conditions' => array('Winner.status' => 'backup')));
				$newWinner['Winner']['status'] = 'pending';
				$newWinner['Winner']['prize'] = $tmpPrize;
				$this->Winner->create();
				if (!$this->Winner->save($newWinner)) {
					$everythinOk = false;
				}
			}
			if ($everythingOk == true) {
				$this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash(__('Error en sistema. Intente de nuevo.'));
			}
		} else {
			$this->request->data = $this->Winner->read(null, $id);
		}
		$this->loadModel('State');
		$statesResult = $this->State->find('all', array('order'=>'State.ord'));
		$states = array();
		$states[0] = "Selecciona un estado";
		foreach($statesResult as $s) {
			$id = $s['State']['id'];
			$name = $s['State']['name'];
			$states[$id] = $name;
		}
		$this->set('states', $states);
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
		$this->Winner->id = $id;
		if (!$this->Winner->exists()) {
			throw new NotFoundException(__('Invalid winner'));
		}
		if ($this->Winner->delete()) {
			$this->Session->setFlash(__('Winner deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Winner was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
