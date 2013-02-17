<?php
App::uses('AppController', 'Controller');
/**
 * Prizes Controller
 *
 * @property Prize $Prize
 */
class PrizesController extends AppController {

/**
 * Grants global permission to some controller functions.
 * @param void
 * @return void
 */
  public function beforeFilter() {
  	$this->Auth->allow('add_from_raffle');
	$this->Auth->allow('get_from_raffle');
    parent::beforeFilter();
  }
  
/**
 * Grants permissions to controller's function given the user's role
 * and the action the user has called.
 * @param	object		$user
 * @return	bool
 */
  public function isAuthorized($user) {
   /* if (isset($user['role']) && $user['role'] === 'stats' && $this->action === 'stats') {
      return true;
    }

    if ((isset($user['role']) && $user['role'] === 'operator') && $this->action === 'main') {
      return true;
    }
	
	if ((isset($user['role']) && $user['role'] === 'stats') && $this->action === 'main') {
      return true;
    }
	
	if ((isset($user['role']) && $user['role'] === 'store') && $this->action === 'main') {
      return true;
    }*/

    return parent::isAuthorized($user);
  }
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

/**
 * adds prizes into database
 * 
 * @param	int			$raffleid	(by post)
 * @param	int			$quantity	(by post)
 * @param	string		$description(by post)
 * @return	string		"ok" on success, otherwise "error"
 */
	public function add_from_raffle() {
		$this->autoRender = false;
		$this->layout = 'ajax';
		if ($this->request->is('post')) {
			$this->Prize->create();
			if ($this->Prize->save($this->request->data)) {
				echo "ok";
			}
			else {
				echo "error";
			}
		}
	}

/**
 * returns the list of prizes given a raffle
 * 
 * @param	int		$raffleid
 * @return	json	list of prizes
 */
	public function get_from_raffle($raffleid = null) {
		$this->autoRender = false;
		$this->layout = 'ajax';
		if ($raffleid != null) {
			$data = $this->Prize->find('all', array('conditions' => array('Prize.idraffle' => $raffleid)));
			$prizes = array();
			$x = 0;
			foreach($data as $prize) {
				$prizes[$x]['id'] = $prize['Prize']['id'];
				$prizes[$x]['quantity'] = $prize['Prize']['quantity'];
				$prizes[$x]['description'] = $prize['Prize']['description'];
				$x += 1;
			}
			echo json_encode($prizes);
		}
	}
	
/**
 * deletes a prize given its id
 * 
 * @param	int		$id
 * @return	string	ok/error
 */
	public function delete_remotely($id = null) {
		$this->autoRender = false;
		$this->layout = 'ajax';
		$ok = false;
		if ($prize != null) {
			$this->Prize->id = $id;
			if ($this->Prize->exist()){
				if ($this->Prize->delete()){
					$ok = true;
				}
			}
		}
		if ($ok)
			echo "prize".$id;
		else 
			echo "error";
	}
}
