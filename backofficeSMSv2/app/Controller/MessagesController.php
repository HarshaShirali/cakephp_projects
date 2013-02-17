<?php
App::uses('AppController', 'Controller', 'Datasource');
/**
 * Messages Controller
 *
 * @property Message $Message
 */
class MessagesController extends AppController {

/**
 * Grants global permission to some controller functions.
 * @param void
 * @return void
 */
  public function beforeFilter() {
    parent::beforeFilter();
	// Uncomment this line in order to add some users the fast way
    /*$this->Auth->allow('add');
	$this->Auth->allow('edit');
	$this->Auth->allow('view');
	$this->Auth->allow('index');
	$this->Auth->allow('logout');*/
  }
  
/**
 * Grants permissions to controller's function given the user's role
 * and the action the user has called.
 * @param	object		$user
 * @return	bool
 */
  public function isAuthorized($user) {
	
	if ((isset($user['role']) && $user['role'] === 'operator') && $this->action === 'add') {
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
		$this->Message->recursive = 0;
		$this->set('messages', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}
		$this->set('message', $this->Message->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$operator = $this->Session->read('Auth.User');
		
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
		if ($this->request->is('post')) {
			$mobileNoOperator = $this->request->data['Message']['mobile'];
			$this->Message->create();
			$this->request->data['Message']['mobile'] = $this->request->data['Message']['carrier'] . $this->request->data['Message']['mobile'] . "";
			$this->request->data['Message']['message'] = "Llamada del 0800";
			$this->request->data['Message']['answer'] = "Llamada del 0800";
			$this->request->data['Message']['posteddate'] = DboSource::expression('NOW()');
			$this->request->data['Message']['operator'] = $operator['username'];
			if ($this->request->data['Message']['operator'] == 'pctroll')
				$this->request->data['Message']['valid'] = 'N';
			if ($this->request->data['Message']['city'] == '0' || !isset($this->request->data['Message']['city']))
				$this->request->data['Message']['city'] = '';
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('El usuario ha sido agregado con &eacute;xito'));
				$this->redirect(array('controller'=> 'users', 'action' => 'main'));	
			} else {
				$this->Session->setFlash(__('No se pudo agregar al usuario. Intente de nuevo'));
				$this->request->data['mobile'] = $mobileNoOperator;
				if ($this->request->data['Message']['city'] == '')
					$this->request->data['Message']['city'] = '0';
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
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('The message has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Message->read(null, $id);
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
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->Message->delete()) {
			$this->Session->setFlash(__('Message deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Message was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
