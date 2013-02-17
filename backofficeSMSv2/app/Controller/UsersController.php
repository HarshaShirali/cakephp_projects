<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'string_utils');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

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
	$this->Auth->allow('index');*/
	$this->Auth->allow('logout');
  }
  
/**
 * Grants permissions to controller's function given the user's role
 * and the action the user has called.
 * @param	object		$user
 * @return	bool
 */
  public function isAuthorized($user) {
    if (isset($user['role']) && $user['role'] === 'stats' && $this->action === 'stats') {
      return true;
    }
	if (isset($user['role']) && $user['role'] === 'stats' && $this->action === 'stats_details') {
      return true;
    }
	if (isset($user['role']) && $user['role'] === 'stats' && $this->action === 'stats_details_excel') {
      return true;
    }
	
	if ((isset($user['role']) && $user['role'] === 'stats') && $this->action === 'main') {
      return true;
    }
	
	if ((isset($user['role']) && $user['role'] === 'contact') && $this->action === 'main') {
      return true;
    }
	
	if ((isset($user['role']) && $user['role'] === 'raffle') && $this->action === 'main') {
      return true;
    }
	
	if ((isset($user['role']) && $user['role'] === 'operator') && $this->action === 'main') {
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
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash(__('The user has been saved'));
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

/**
 * Shows the main menu
 */
  public function main() {
  	$userRole = $this->Session->read('Auth.User.role');
	$this->set('userRole', $userRole);
	
  	if ($this->Session->read('Auth.User.role') == 'raffle') {
		$raffleId = 0;
		$this->loadModel('Raffle');
		$todayBegin = date('Y-m-d')." 00:00:00";
		$todayEnd = date('Y-m-d')." 23:59:59"; 
		$raffle = $this->Raffle->find('first', array('conditions' => array('Raffle.raffledate >=' => $todayBegin,
		                                                                  'Raffle.raffledate <=' => $todayEnd,
																		  'Raffle.locked' => 'N')));
		if ($raffle != null) {
			$raffleId = $raffle['Raffle']['id'];
		}
		$this->set('raffleId', $raffleId);
  	}
	
  }

/**
 * Shows the status of the promotion
 * 
 * @return void
 */
 	public function stats() {
		$this->loadModel('Message');
		if ($this->request->is('post') && $this->request->data['Stats']['begin'] != "") {
			$beginDate = $this->request->data['Stats']['begin'] . " 00:00:00";
			$endDate = $this->request->data['Stats']['end'] . " 23:59:59";
		}
		else{
			$today = getdate(); 
			$now = $today['year']."-".$today['mon']."-".$today['mday'];
			$nowString = $today['mday'].'/'.$today['mon'].'/'.$today['year'];
			$beginDate = $now. " 00:00:00";
			$endDate = $now . " 23:59:59";
			$this->Session->setFlash(__('Status de hoy: '.$nowString));
		}

		

		$smsValid  = $this->Message->find('count', array('conditions' => array('Message.posteddate >=' => $beginDate,
																			'Message.posteddate <=' => $endDate,
																			'Message.operator' => 'SMS',
																			'Message.valid' => 'Y')));
		$smsNotValid  = $this->Message->find('count', array('conditions' => array('Message.posteddate >=' => $beginDate,
																			   'Message.posteddate <=' => $endDate,
																			   'Message.operator' => 'SMS',
																			   'Message.valid' => 'N')));
		$digitel	= $this->Message->find('count', array('conditions' => array('Message.posteddate >=' => $beginDate,
																			    'Message.posteddate <=' => $endDate,
																				'Message.operator' => 'SMS',
		                                                                        'Message.mobile LIKE' => '58412%')));
		$allCarriers= $this->Message->find('count', array('conditions' => array('Message.posteddate >=' => $beginDate,
																			    'Message.posteddate <=' => $endDate,
																				'Message.operator' => 'SMS')));
		$callcenter	= $this->Message->find('count', array('conditions' => array('Message.posteddate >=' => $beginDate,
																			    'Message.posteddate <=' => $endDate,
																				'Message.valid' => 'Y',
																				'Message.operator NOT' => 'SMS')));
		$movilnet1	= $this->Message->find('count', array('conditions' => array('Message.posteddate >=' => $beginDate,
																			    'Message.posteddate <=' => $endDate,
																				'Message.operator' => 'SMS',
																				'Message.mobile LIKE' => '158%')));
		$movilnet2	= $this->Message->find('count', array('conditions' => array('Message.posteddate >=' => $beginDate,
																			    'Message.posteddate <=' => $endDate,
																				'Message.operator' => 'SMS',
																				'Message.mobile LIKE' => '199%')));
		$movistar1	= $this->Message->find('count', array('conditions' => array('Message.posteddate >=' => $beginDate,
																			    'Message.posteddate <=' => $endDate,
																				'Message.operator' => 'SMS',
																				'Message.mobile LIKE' => '0414%')));
		$movistar2	= $this->Message->find('count', array('conditions' => array('Message.posteddate >=' => $beginDate,
																			    'Message.posteddate <=' => $endDate,
																				'Message.operator' => 'SMS',
																				'Message.mobile LIKE' => '0424%')));
		$movilnet	= $movilnet1 + $movilnet2;
		$movistar	= $movistar1 + $movistar2;
		$others		= ($smsValid + $smsNotValid) - ($digitel + $movilnet + $movistar);
		$this->set('valid', ($smsValid + $callcenter));
		$this->set('smsValid', $smsValid);
		$this->set('smsNotValid', $smsNotValid);
		$this->set('smsTotal', ($smsValid + $smsNotValid));
		$this->set('digitel', $digitel);
		$this->set('movilnet', $movilnet);
		$this->set('movistar', $movistar);
		$this->set('others', $others);
		$this->set('callcenter', $callcenter);
 	}
	
/**

*/
	public function stats_details(){
		$this->loadModel('Message');
		$cities 		= $this->Message->find('all', array('conditions'=> array('Message.city NOT' => '',
		                                                                          'Message.operator NOT' => 'SMS'),
															'fields'    => array('Message.city',
															                     'COUNT(1) as message_num'),
															'group'     => 'Message.city',
															'order'     => 'message_num DESC',
															'limit'     => 5));
		
		
		$report = array();
		$total			= $this->Message->find('all', array('fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
		                                                                     'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		$valid			= $this->Message->find('all', array('conditions' => array('Message.valid' => 'Y'),
															'fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
																			 'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		$notValid		= $this->Message->find('all', array('conditions' => array('Message.valid' => 'N'),
															'fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
		                                                                     'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		$digitel		= $this->Message->find('all', array('conditions' => array('Message.mobile LIKE' => '58412%',
		                                                                          'Message.operator' => 'SMS'),
		                                                    'fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
		                                                                     'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		$movilnet1		= $this->Message->find('all', array('conditions' => array('Message.mobile LIKE' => '158%',
		                                                                          'Message.operator' => 'SMS'),
		                                                    'fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
		                                                                     'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		$movilnet2		= $this->Message->find('all', array('conditions' => array('Message.mobile LIKE' => '199%',
		                                                                          'Message.operator' => 'SMS'),
		                                                    'fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
		                                                                     'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		$movistar1		= $this->Message->find('all', array('conditions' => array('Message.mobile LIKE' => '0414%',
		                                                                          'Message.operator' => 'SMS'),
		                                                    'fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
		                                                                     'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		$movistar2		= $this->Message->find('all', array('conditions' => array('Message.mobile LIKE' => '0424%',
		                                                                          'Message.operator' => 'SMS'),
		                                                    'fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
		                                                                     'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		$callcenter		= $this->Message->find('all', array('conditions' => array('Message.operator NOT' => 'SMS',
		                                                                          'Message.valid' => 'Y'),
		                                                    'fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
		                                                                     'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		foreach ($total as $t) {
			$report[$t[0]['message_msgdate']]['date'] = $t[0]['message_msgdate'];
			$report[$t[0]['message_msgdate']]['total'] = $t[0]['message_num'];
			$report[$t[0]['message_msgdate']]['valid'] = 0;
			$report[$t[0]['message_msgdate']]['notvalid'] = 0;
			$report[$t[0]['message_msgdate']]['digitel'] = 0;
			$report[$t[0]['message_msgdate']]['movilnet'] = 0;
			$report[$t[0]['message_msgdate']]['movistar'] = 0;
			$report[$t[0]['message_msgdate']]['others'] = 0;
			$report[$t[0]['message_msgdate']]['callcenter'] = 0;
		}
		foreach ($valid as $v) {
			$report[$v[0]['message_msgdate']]['valid'] = $v[0]['message_num'];
		}
		foreach ($notValid as $nv) {
			$report[$nv[0]['message_msgdate']]['notvalid'] = $nv[0]['message_num'];
		}
		foreach ($digitel as $d) {
			$report[$d[0]['message_msgdate']]['digitel'] = $d[0]['message_num'];
		}
		foreach ($movilnet1 as $m) {
			$report[$m[0]['message_msgdate']]['movilnet'] = $m[0]['message_num'] + 0;
		}
		foreach ($movilnet2 as $m) {
			$report[$m[0]['message_msgdate']]['movilnet'] += $m[0]['message_num'];
		}
		foreach ($movistar1 as $m) {
			$report[$m[0]['message_msgdate']]['movistar'] = $m[0]['message_num'] + 0;
		}
		foreach ($movistar2 as $m) {
			$report[$m[0]['message_msgdate']]['movistar'] += $m[0]['message_num'];
		}
		foreach ($callcenter as $m) {
			$report[$m[0]['message_msgdate']]['callcenter'] += $m[0]['message_num'];
		}
		foreach ($report as $r) {
			$report[$r['date']]['others'] = $r['total'] - ($r['digitel'] + $r['movilnet'] + $r['movistar']);
		}
		
		$this->set('report', $report);
		$this->set('cities', $cities);
	}
	
	
	
	public function stats_details_excel(){
		$this->loadModel('Message');
		$this->layout = 'excel';
		$cities 		= $this->Message->find('all', array('conditions'=> array('Message.city NOT' => '',
		                                                                          'Message.operator NOT' => 'SMS'),
															'fields'    => array('Message.city',
															                     'COUNT(1) as message_num'),
															'group'     => 'Message.city',
															'order'     => 'message_num DESC',
															'limit'     => 5));
		
		
		$report = array();
		$total			= $this->Message->find('all', array('fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
		                                                                     'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		$valid			= $this->Message->find('all', array('conditions' => array('Message.valid' => 'Y'),
															'fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
																			 'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		$notValid		= $this->Message->find('all', array('conditions' => array('Message.valid' => 'N'),
															'fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
		                                                                     'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		$digitel		= $this->Message->find('all', array('conditions' => array('Message.mobile LIKE' => '58412%',
		                                                                          'Message.operator' => 'SMS'),
		                                                    'fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
		                                                                     'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		$movilnet1		= $this->Message->find('all', array('conditions' => array('Message.mobile LIKE' => '158%',
		                                                                          'Message.operator' => 'SMS'),
		                                                    'fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
		                                                                     'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		$movilnet2		= $this->Message->find('all', array('conditions' => array('Message.mobile LIKE' => '199%',
		                                                                          'Message.operator' => 'SMS'),
		                                                    'fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
		                                                                     'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		$movistar1		= $this->Message->find('all', array('conditions' => array('Message.mobile LIKE' => '0414%',
		                                                                          'Message.operator' => 'SMS'),
		                                                    'fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
		                                                                     'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		$movistar2		= $this->Message->find('all', array('conditions' => array('Message.mobile LIKE' => '0424%',
		                                                                          'Message.operator' => 'SMS'),
		                                                    'fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
		                                                                     'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		$callcenter		= $this->Message->find('all', array('conditions' => array('Message.operator NOT' => 'SMS'),
		                                                    'fields'=> array('DATE(`Message`.`posteddate`) AS `message_msgdate`',
		                                                                     'COUNT(1) AS message_num'),
															'group'	=> array('`message_msgdate`')));
		foreach ($total as $t) {
			$report[$t[0]['message_msgdate']]['date'] = $t[0]['message_msgdate'];
			$report[$t[0]['message_msgdate']]['total'] = $t[0]['message_num'];
			$report[$t[0]['message_msgdate']]['valid'] = 0;
			$report[$t[0]['message_msgdate']]['notvalid'] = 0;
			$report[$t[0]['message_msgdate']]['digitel'] = 0;
			$report[$t[0]['message_msgdate']]['movilnet'] = 0;
			$report[$t[0]['message_msgdate']]['movistar'] = 0;
			$report[$t[0]['message_msgdate']]['others'] = 0;
			$report[$t[0]['message_msgdate']]['callcenter'] = 0;
		}
		foreach ($valid as $v) {
			$report[$v[0]['message_msgdate']]['valid'] = $v[0]['message_num'];
		}
		foreach ($notValid as $nv) {
			$report[$nv[0]['message_msgdate']]['notvalid'] = $nv[0]['message_num'];
		}
		foreach ($digitel as $d) {
			$report[$d[0]['message_msgdate']]['digitel'] = $d[0]['message_num'];
		}
		foreach ($movilnet1 as $m) {
			$report[$m[0]['message_msgdate']]['movilnet'] = $m[0]['message_num'] + 0;
		}
		foreach ($movilnet2 as $m) {
			$report[$m[0]['message_msgdate']]['movilnet'] += $m[0]['message_num'];
		}
		foreach ($movistar1 as $m) {
			$report[$m[0]['message_msgdate']]['movistar'] = $m[0]['message_num'] + 0;
		}
		foreach ($movistar2 as $m) {
			$report[$m[0]['message_msgdate']]['movistar'] += $m[0]['message_num'];
		}
		foreach ($callcenter as $m) {
			$report[$m[0]['message_msgdate']]['callcenter'] += $m[0]['message_num'];
		}
		foreach ($report as $r) {
			$r['others'] = $r['total'] - ($r['digitel'] - $r['movilnet'] - $r['movistar']);
		}
		
		$this->set('report', $report);
		$this->set('cities', $cities);
	}
}
