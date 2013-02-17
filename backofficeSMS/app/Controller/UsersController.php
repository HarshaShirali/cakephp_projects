<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'string_utils');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

  public function beforeFilter() {
    parent::beforeFilter();
    //$this->Auth->allow('add');
	$this->Auth->allow('logout');
  }
  
  public function isAuthorized($user) {
    if (isset($user['role']) && $user['role'] === 'stats' && $this->action === 'stats') {
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
    }

    return parent::isAuthorized($user);
  }

  /**
   * index method
   *
   * @return void
   */
  public function index() {
    $this->User->recursive = 0;
    $this->set('users', $this->paginate());
  }

  /**
   * view method
   *
   * @param string $id
   * @return void
   */
  public function view($id = null) {
    $this->User->id = $id;
    if (!$this->User->exists()) {
      throw new NotFoundException(__('Invalid user'));
    }
    $this->set('user', $this->User->read(null, $id));
  }

  /**
   * add method
   *
   * @return void
   */
  public function add() {
    if ($this->request->is('post')) {
      $pass = $this->request->data['User']['password'];
      $this->User->create();
      $this->request->data['User']['salt'] = StringUtils::getRandomString();
      /*
      $this->request->data['User']['password'] = hash('sha256',
        $this->request->data['User']['salt'].
        $pass);
       */
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash(__('The user has been saved'));
		$this->request->data['User']['name'] = "";
		$this->request->data['User']['username'] = "";
		$this->request->data['User']['password'] = "";
      } else {
        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
    $this->User->id = $id;
    if (!$this->User->exists()) {
      throw new NotFoundException(__('Invalid user'));
    }
    if ($this->request->is('post') || $this->request->is('put')) {
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash(__('The user has been saved'));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
      }
    } else {
      $this->request->data = $this->User->read(null, $id);
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
    $this->User->id = $id;
    if (!$this->User->exists()) {
      throw new NotFoundException(__('Invalid user'));
    }
    if ($this->User->delete()) {
      $this->Session->setFlash(__('User deleted'));
      $this->redirect(array('action' => 'index'));
    }
    $this->Session->setFlash(__('User was not deleted'));
    $this->redirect(array('action' => 'index'));
  }

  /**
   * Login function for authentication.
   * 
   * @return void
   */
	public function login() {
    	if ($this->request->is('post')) {
  			if($this->Auth->login()) {
    			$this->redirect($this->Auth->redirect());
  			}else {
    			$this->Session->setFlash('Usuario o contrase&ntilde;a no v&aacute;lida.');
				$this->redirect(array('controller'=>'users', 'action'=>'login'));
      		}
    	}
	}

  /**
   * Logout function.
   * 
   * @return void
   */
	public function logout() {
		$this->Auth->logout();
		$this->redirect(array('controller' => 'users', 'action' => 'login'));
	}

  public function main() {}

/**
 * Shows the status of the promotion
 * 
 * @return void
 */
 	public function stats() {
 		$this->loadModel('Code');
		$this->loadModel('Prize');
		$this->loadModel('Message');
		$this->loadModel('Mobile');
		if ($this->request->is('post') && $this->request->data['Stats']['begin'] != "") {
			$beginDate = $this->request->data['Stats']['begin'] . " 00:00:00";
			$endDate = $this->request->data['Stats']['end'] . " 23:59:59";
		}
		else{
			$today = getdate(); 
			$now = $today['year']."-".$today['mon']."-".$today['mday'];
			$beginDate = $now. " 00:00:00";
			$endDate = $now . " 23:59:59";
			$this->Session->setFlash(__('Status del día'));
		}
		
		$codesUsed = $this->Code->find('count', array('conditions'=>array('Code.used >' => 0,
																		  'Code.timeused >=' => $beginDate,
																		  'Code.timeused <=' => $endDate)));
		$codesBackup = $this->Code->find('count', array('conditions'=>array('Code.reported >' => 0,
																			'Code.timereported >=' => $beginDate,
																			'Code.timereported <=' => $endDate)));
		$prizes = $this->Prize->find('count', array('conditions'=>array('Prize.used >' => 0,
																		'Prize.time >=' => $beginDate,
																		'Prize.time <=' => $endDate)));
		$sms = $this->Message->find('count', array('conditions'=>array('Message.id > '=>0,
																	   'Message.posteddate >=' => $beginDate,
																	   'Message.posteddate <=' => $endDate)));
		$mobilesGiven = $this->Mobile->find('count', array('conditions'=>array('Mobile.dategiven >=' => $beginDate,
																			   'Mobile.dategiven <=' => $endDate,
																			   "OR"=> array('Mobile.status' => 'given',
																			                'Mobile.status' => 'published'))));

		
		$this->set('codesUsed', $codesUsed);
		$this->set('codesBackup', $codesBackup);
		$this->set('prizes', $prizes);
		$this->set('sms', $sms);
		$this->set('mobilesGiven', $mobilesGiven);
 	}
}
