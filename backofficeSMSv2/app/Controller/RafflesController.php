<?php
App::uses('AppController', 'Controller', 'Datasource');
/**
 * Raffles Controller
 *
 * @property Raffle $Raffle
 */
class RafflesController extends AppController {

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
    if (isset($user['role']) && $user['role'] === 'raffle' && $this->action === 'get_winners') {
      return true;
    }
	
	if (isset($user['role']) && $user['role'] === 'raffle' && $this->action === 'get_winners_excel') {
      return true;
    }

	if (isset($user['role']) && $user['role'] === 'raffle' && $this->action === 'lock') {
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
		$this->Raffle->recursive = 0;
		$this->set('raffles', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->loadModel('Prize');
		$this->loadModel('Winner');
		$this->Raffle->id = $id;
		if (!$this->Raffle->exists()) {
			throw new NotFoundException(__('Invalid raffle'));
		}
		$raffle = $this->Raffle->read(null, $id);
		$id = $raffle['Raffle']['id'];
		$date = substr($raffle['Raffle']['raffledate'], 0, 10);
		$locked = "No";
		if ($raffle['Raffle']['locked'] == 'Y') {
			$locked = "Si";
		}
		$prizes = $this->Prize->find('all', array('conditions' => array('Prize.idraffle' => $id)));
		$this->set('id', $id);
		$this->set('date', $date);
		$this->set('locked', $locked);
		$this->set('prizes', $prizes);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Raffle->create();
			$this->request->data['Raffle']['raffledate'] .= ' 00:00:00';
			if ($this->Raffle->save($this->request->data)) {
				$id = $this->Raffle->id;
				$this->Session->setFlash(__('Sorteo creado satisfactoriamente.'));
				$this->redirect(array('action' => 'edit', $id));
			} else {
				$this->Session->setFlash(__('Error en sistema. Intente de nuevo.'));
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
		$this->Raffle->id = $id;
		if (!$this->Raffle->exists()) {
			throw new NotFoundException(__('Sorteo inválido'));
		}
		$this->loadModel('Prize');
		$prizes = $this->Prize->find('all', array('conditions' => array('Prize.idraffle' => $id)));
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data = $this->request->data['Raffle'];
			if ($this->Raffle->save($this->request->data)) {
				$this->Session->setFlash(__('Sorteo modificado'));
				$this->redirect(array('action' => 'index'));
				pr($this->request->data);
			} else {
				$this->Session->setFlash(__('No se pudo guardar los cambios. Intenta de nuevo.'));
			}
		} else {
			$this->request->data = $this->Raffle->read(null, $id);
			$this->request->data['Raffle']['raffledate'] =  substr($this->request->data['Raffle']['raffledate'], 0, 10);	
		}
		$this->set('prizes', $prizes);
		$this->set('raffleId', $id);
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
		$this->Raffle->id = $id;
		if (!$this->Raffle->exists()) {
			throw new NotFoundException(__('Invalid raffle'));
		}
		if ($this->Raffle->delete()) {
			$this->Session->setFlash(__('Raffle deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Raffle was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * gets winners
 * @param	int		$id
 * @return	void
 */
	public function get_winners($id = null) {
		$this->Raffle->id = $id;
		$isRaffleDone = false;
		if (!$this->Raffle->exists()) {
			throw new NotFoundException(__('Sorteo inválido'));
		}
		$toShow = "form";
		$this->loadModel('Prize');
		$this->loadModel('Message');
		$this->loadModel('Mobile');
		$this->loadModel('Winner');
		$this->loadModel('Report');
		if ($this->request->is('post') || $this->request->is('put')) {
			$raffle = $this->Raffle->find('first', array('conditions' => array('Raffle.id' => $id)));
			if ($raffle['Raffle']['locked'] == 'Y') {
				$this->redirect(array('action' => 'view', $id));
			}
			$toShow = "result";
			$this->Winner->deleteAll(array('Winner.idraffle' => $id), false);
			$this->Report->deleteAll(array('Report.idraffle' => $id), false);
			$pastWinners = array();
			$pastWinners = $this->Winner->get_past();
			$prizes = $this->Prize->find('all', array('conditions' => array('Prize.idraffle' => $id)));
			$prizesList = array();
			$numPrizes = 0;
			$numBackups = $this->request->data['Raffle']['backups'];
			// fill the prize list one by one
			foreach ($prizes as $prize) {
				$numPrizes += $prize['Prize']['quantity'];
				for($x = 0; $x < $prize['Prize']['quantity']; $x++) {
					array_push($prizesList, $prize['Prize']['description']);
				}
			}
			// fill the backup list one by one
			for ($x = 0; $x < $numBackups; $x++) {
				array_push($prizesList, "Backup");
			}
			$numParticipants = $numPrizes + $numBackups; 
			$numPlayers = $this->Message->find('count', array(
						'conditions' => array('Message.valid' => 'Y',
											  'Message.id NOT' => $pastWinners),
						'order' => 'rand()',
						//'fields' => array('Message.id', 'Message.mobile', 'Message.valid', 'Message.name', 'Message.idcard', 'Message.receipt', 'Message.posteddate'),
						'limit' => $numParticipants,
						'group' => 'Message.idnumber'));
			$players = $this->Message->find('all', array(
						'conditions' => array('Message.valid' => 'Y',
											  'Message.id NOT' => $pastWinners),
						'order' => 'rand()',
						//'fields' => array('Message.id', 'Message.mobile', 'Message.valid', 'Message.name', 'Message.idcard', 'Message.receipt', 'Message.posteddate'),
						'limit' => $numParticipants,
						'group' => 'Message.idnumber'));
			$numParticipants = $numPlayers;
			$winners = array('Winner'=>array());
			date_default_timezone_set('America/Caracas');
			$todayDate = date('Y-m-d H:i:s');
			
			$myWinnerQuery = "INSERT INTO winners (idmessage, idraffle, messageposteddate, mobile, idcard, name, last, receipt, prize, mobile2, city, posteddate, status) VALUES ";
			$myReportQuery = "INSERT INTO reports (idmessage, idraffle, messageposteddate, mobile, idcard, name, last, receipt, prize, mobile2, city, posteddate, status) VALUES ";
			
			for ($i = 0; $i < $numParticipants; $i++) {
				$status = 'pending';
				if ($i >= $numPrizes) {
					$status = 'backup';
				}
				$newwinner = array('idmessage'			=> $players[$i]['Message']['id'],
				                   'idraffle'			=> $id,				                   
								   'messageposteddate'	=> $players[$i]['Message']['posteddate'],
								   'mobile'				=> $this->Mobile->get_normal($players[$i]['Message']['mobile']),
								   'idcard'				=> $players[$i]['Message']['idnumber'],
								   'name'				=> $players[$i]['Message']['name'],
								   'last'				=> $players[$i]['Message']['last'],
								   'receipt'			=> $players[$i]['Message']['receipt'],
								   'prize'				=> $prizesList[$i],
								   'mobile2'			=> $this->Mobile->get_normal($players[$i]['Message']['mobile2']),
								   'city'				=> $players[$i]['Message']['city'],
								   'posteddate'			=> $todayDate,
								   'status'				=> $status);
				array_push($winners['Winner'], $newwinner);
				if ($i > 0) {
					$myWinnerQuery .= ', ';
					$myReportQuery .= ', ';
				}
				$myWinnerQuery .= '('.$newwinner['idmessage'].',';
				$myWinnerQuery .= ''.$newwinner['idraffle'].',';
				$myWinnerQuery .= "'".$newwinner['messageposteddate']."',";
				$myWinnerQuery .= "'".$newwinner['mobile']."',";
				$myWinnerQuery .= ''.$newwinner['idcard'].',';
				$myWinnerQuery .= "'".$newwinner['name']."',";
				$myWinnerQuery .= "'".$newwinner['last']."',";
				$myWinnerQuery .= "'".$newwinner['receipt']."',";
				$myWinnerQuery .= "'".$newwinner['prize']."',";
				$myWinnerQuery .= "'".$newwinner['mobile2']."',";
				$myWinnerQuery .= "'".$newwinner['city']."',";
				$myWinnerQuery .= "'".$newwinner['posteddate']."',";
				$myWinnerQuery .= "'".$newwinner['status']."')";
				
				$myReportQuery .= '('.$newwinner['idmessage'].',';
				$myReportQuery .= ''.$newwinner['idraffle'].',';
				$myReportQuery .= "'".$newwinner['messageposteddate']."',";
				$myReportQuery .= "'".$newwinner['mobile']."',";
				$myReportQuery .= ''.$newwinner['idcard'].',';
				$myReportQuery .= "'".$newwinner['name']."',";
				$myReportQuery .= "'".$newwinner['last']."',";
				$myReportQuery .= "'".$newwinner['receipt']."',";
				$myReportQuery .= "'".$newwinner['prize']."',";
				$myReportQuery .= "'".$newwinner['mobile2']."',";
				$myReportQuery .= "'".$newwinner['city']."',";
				$myReportQuery .= "'".$newwinner['posteddate']."',";
				$myReportQuery .= "'".$newwinner['status']."')";
			}
			$myWinnerQuery .= ";";
			$myReportQuery .= ";";
			//pr($myWinnerQuery);
			//pr($myReportQuery);
			$this->Winner->create();
			$this->Winner->query($myWinnerQuery);
			$this->Report->create();
			$this->Report->query($myReportQuery);
			
			$this->set('winners', $winners['Winner']);
			$this->set('id', $id);
			$isRaffleDone = true;
		}
		else {
			$prizes = $this->Prize->find('all', array('conditions' => array('Prize.idraffle' => $id)));
			$this->set('prizes', $prizes);
		}
		$this->request->data = $this->Raffle->read(null, $id);
		$year = substr($this->request->data['Raffle']['raffledate'], 0, 4);
		$month = substr($this->request->data['Raffle']['raffledate'], 5, 2);
		$day = substr($this->request->data['Raffle']['raffledate'], 8, 2);
		$date = $day."/".$month."/".$year; 
		$this->set('date', $date);
		$this->set('toShow', $toShow);
		$this->set('isRaffleDone', $isRaffleDone);
	}

/**
 * Exports the results of a given raffle to Excel format
 * @param	int		$id
 * @return	void
 */
	public function get_winners_excel($id = null) {
		$this->layout = 'excel';
		if ($id != null) {
			$this->loadModel('Winner');
			$winners = $this->Winner->find('all', array('conditions' => array('Winner.idraffle' => $id),
														'order' => 'Winner.id ASC'));
			$winners_count = $this->Winner->find('count', array('conditions' => array('Winner.idraffle' => $id,
			                                                                          'Winner.prize NOT' => 'Backup')));
			$backup_count = $this->Winner->find('count', array('conditions' => array('Winner.idraffle' => $id,
			                                                                          'Winner.prize' => 'Backup')));
			$this->set('winners', $winners);
			$this->set('winners_count', $winners_count);
			$this->set('backup_count', $backup_count);
			$promoName = "Nombre de la promocion";
			$this->set('promoName', $promoName);
		}
	}

/**
 * Locks the raffle in order to close it.
 * @param	int		$id
 * @return	void 
 */
	public function lock($id = null) {
		$this->Raffle->id = $id;
		$this->autoRender = false;
		$this->layout = 'ajax';
		if ($id != null) {
			if ($this->Raffle->exists()) {
				$raffle = $this->Raffle->read(null, $id);
				$raffle['Raffle']['locked'] = 'Y';
				$this->Raffle->save($raffle); 
			}
		}
		$this->redirect(array('controller' => 'users', 'action' => 'main'));
	}
}
