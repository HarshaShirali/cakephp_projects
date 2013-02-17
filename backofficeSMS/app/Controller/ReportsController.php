<?php
App::uses('AppController', 'Controller', 'Datasource');
/**
 * Reports Controller
 *
 * @property Report $Report
 */
class ReportsController extends AppController {

  public function isAuthorized($user) {
    if ((isset($user['role']) && $user['role'] === 'operator') && $this->action === 'new_report') {
      return true;
    }
	if ((isset($user['role']) && $user['role'] === 'operator') && $this->action === 'logout') {
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
		$this->Report->recursive = 0;
		$this->set('reports', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Report->id = $id;
		if (!$this->Report->exists()) {
			throw new NotFoundException(__('Invalid report'));
		}
		$this->set('report', $this->Report->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Report->create();
			if ($this->Report->save($this->request->data)) {
				$this->Session->setFlash(__('The report has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The report could not be saved. Please, try again.'));
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
		$this->Report->id = $id;
		if (!$this->Report->exists()) {
			throw new NotFoundException(__('Invalid report'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Report->save($this->request->data)) {
				$this->Session->setFlash(__('The report has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The report could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Report->read(null, $id);
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
		$this->Report->id = $id;
		if (!$this->Report->exists()) {
			throw new NotFoundException(__('Invalid report'));
		}
		if ($this->Report->delete()) {
			$this->Session->setFlash(__('Report deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Report was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * 
 * @return void
 */
	public function new_report() {
		$this->loadModel('Code');
		$this->loadModel('State');
		$operator = $this->Session->read('Auth.User');
		$isCodes = $this->Code->check_codes();
		$statesResult = $this->State->find('all', array('order'=>'State.ord'));
		$states = array();
		$states[0] = "Selecciona un estado";
		foreach($statesResult as $s) {
			$id = $s['State']['id'];
			$name = $s['State']['name'];
			$states[$id] = $name;
		}
		$this->set('states', $states);
		$this->Session->write('States', $states);
		if ($isCodes == "no") {
			$this->Session->setFlash(__('No quedan códigos de respaldo para enviar.'));
		}
		if ($this->request->is('post') && $isCodes == "yes") {
			$sessionStates = $this->Session->read('States');
			$stateId = $this->request->data['Report']['state'];
			$this->request->data['Report']['state'] = $sessionStates[$this->request->data['Report']['state']];
			$this->request->data['Report']['operator'] = $operator['id'];
			$this->request->data['Report']['time'] = DboSource::expression('NOW()');
			$this->request->data['Report']['code'] = $this->Code->get_new();
			$city = $this->request->data['Report']['city'];
			$this->Report->create();
			if ($this->Report->save($this->request->data)) {
				$danaSuccess = $this->dana($this->request->data['Report']['name'],
										   $this->request->data['Report']['last'],
										   $this->request->data['Report']['code'],
										   $this->request->data['Report']['carrier'].$this->request->data['Report']['mobile']);
				if ($danaSuccess == true) {
					$this->Code->kill_code($this->request->data['Report']['code']);
					$this->Session->setFlash(__('El reporte fue generado de forma exitosa'));
					$this->redirect(array('controller'=> 'users', 'action' => 'main'));	
				}
				else {
					$this->Session->setFlash(__('Problema en el envío del SMS'));
				}
			} else {
				$this->Session->setFlash(__('El reporte no fue generado. Por favor revise los campos.'));
			}
		}
	}

/**
 * Checks whether the city written belongs to the chosen state.
 *
 * @returns bool (1/0)
 */
	private function check_city($stateId, $city) {
		$this->loadModel('City');
		$this->City->find('first', array('conditions' => array('City.idstate' => $stateId, 'City.name' => $city)));
		return $this->City->getAffectedRows();
	}


/**
 * Calls the Dana's API in order to send text messages to mobile
 * phones.
 *
 * @return bool		success or not.
 */
	private function dana($name, $last, $code, $mobile){
		$this->loadModel('Danarequest');
		try {
			$idCompany  = 'equilibrio';
			$login      = 'enviosms';
			$password   = 'Ap3072012';
			$tableCode = "PEPSI_MASIVA2012"; 
			$idConversation="12676";
			$idconv = 12676;
	
			$values [0] = array ('key'   =>'PEPSI_MASIVA2012_NOMBRE', 
								 'value' => $name); 
			$values [1] = array ('key'   => 'PEPSI_MASIVA2012_APELLIDO', 
 					 			 'value' => $last); 
			$values [2] = array ('key'   => 'PEPSI_MASIVA2012_CODIGO', 
								 'value' => $code); 
   			$values [3] = array ('key'   => 'PEPSI_MASIVA2012_TELEFONO', 
								 'value' => $mobile); 
			$valuesMap['values']['entry'] = $values; 
					 
		    $dana = new SoapClient('http://appserv.danacrm.net:80/dana/conversation/ConversationWebServiceNoSSL?wsdl'); 
			$args = array('idCompany' => $idCompany, 
						  'login'     => $login, 
						  'password'  => $password, 
						  'idConversation' =>$idConversation,
						  'tableCode' => $tableCode, 
					   	  'values'    => $valuesMap); 
					 
		    $result = $dana->startConversationWithData($args)->return;
			
			$this->Danarequest->create();
			$this->request->data['Danarequest']['tablecode'] = $tableCode;
			$this->request->data['Danarequest']['idconversation'] = $idconv;
			$this->request->data['Danarequest']['name'] = $name;
			$this->request->data['Danarequest']['last'] = $last;
			$this->request->data['Danarequest']['mobile'] = $mobile;
			$this->request->data['Danarequest']['code'] = $code;
			$this->request->data['Danarequest']['time'] = DboSource::expression('NOW()');
			$this->Danarequest->save($this->request->data);
			return true;
		} catch(Exception $ex) { 
			//echo $ex->getMessage(); 
			//echo '<br>'; 
			//echo $ex->getTraceAsString();
			return false;
		} 
	}
}