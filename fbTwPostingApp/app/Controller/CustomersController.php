<?php
App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');
/**
 * Customers Controller
 *
 * @property Customer $Customer
 */
class CustomersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->loadModel('Mobile');
		$facebook = new Facebook($this->facebookConfig);
		$user = $facebook->getUser();
		if ($this->request->is('post')){
			$this->redirect(array('controller'=>'customers', 'action'=>'edit', $user));
		}
		$data = $this->Customer->find('first', array('conditions' => array('Customer.id'=>$user)));
		$mobile = $data['Customer']['mobile'];
		if ($mobile == '') {
			$mobile = 'No ha sido configurado';
		}
		else {
			$mobile = $this->Mobile->get_normal($mobile);
		}
		if ($data['Customer']['country'] == '') {
			$country = 'No ha sido configurado';
		}
		else {
			$index = $data['Customer']['country'];
			$country = $this->countries[$index];
		}
		$twitterImg = 'twitterOff';
		$twitterTxt = "Conectar con Twitter";
		$twitterLink = "";
		if ($data['Customer']['twverified'] != 0) {
			$twitterImg = 'twitterOn';
			$twitterTxt = "Conectado con Twitter";
			$twitterLink = '#';
		}
		else {
			$twitteroauth = new TwitterOAuth($this->twitterConfig['key'], $this->twitterConfig['secret']);
			$tempCredentials = $twitteroauth->getRequestToken();
			$twitterUrl = $twitteroauth->getAuthorizeURL($tempCredentials);
			$twitterLink = $twitterUrl."&info=".$user;
			$data['Customer']['oauth_token'] = $tempCredentials['oauth_token'];
			$data['Customer']['oauth_token_secret'] = $tempCredentials['oauth_token_secret'];
			$this->Customer->save($data);
		}
		$this->set('twitterImg', $twitterImg);
		$this->set('twitterTxt', $twitterTxt);
		$this->set('twitterLink', $twitterLink);
		$this->set('mobile', $mobile);
		$this->set('country', $country);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Customer->id = $id;
		if (!$this->Customer->exists()) {
			throw new NotFoundException(__('Invalid customer'));
		}
		$this->set('customer', $this->Customer->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Customer->create();
			if ($this->Customer->save($this->request->data)) {
				$this->Session->setFlash(__('The customer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->loadModel('Mobile');
		$user = $id;
		if ($this->request->is('post') || $this->request->is('put')) {
			pr("Post arrived");
			$facebook = new Facebook($this->facebookConfig);
			$data = $this->Customer->find('first', array('conditions' => array('Customer.id'=>$facebook->getUser())));
			$operator = $this->request->data['Customer']['operator'];
			$mobile = $this->request->data['Customer']['mobile'];
			$this->request->data['Customer']['id'] = $facebook->getUser();
			$this->request->data['Customer']['mobile'] = $this->request->data['Customer']['operator'].$this->request->data['Customer']['mobile'];
			unset($this->request->data['Customer']['operator']);
			if ($this->Customer->save($this->request->data)) {
				$this->redirect(array('action' => 'index'));
				$this->Session->setFlash(__('Cambios guardados'));
			} else {
				$this->Session->setFlash(__('Error. Intente de nuevo.'));
				$this->request->data['Customer']['operator'] = $operator;
				$this->request->data['Customer']['mobile'] = $mobile;
			}
		} else {
			$this->request->data = $this->Customer->find('first', array('conditions' => array('Customer.id'=>$user)));
			$mobile = $this->request->data['Customer']['mobile'];
			if ($mobile != "") {
				$this->request->data['Customer']['operator'] = $this->Mobile->get_operator($mobile);
				$this->request->data['Customer']['mobile'] = $this->Mobile->no_operator($mobile);
			}
		}
		$this->set('countries', $this->countries);
		$this->set('operators', $this->operators);
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Customer->id = $id;
		if (!$this->Customer->exists()) {
			throw new NotFoundException(__('Invalid customer'));
		}
		if ($this->Customer->delete()) {
			$this->Session->setFlash(__('Customer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Customer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * Handles the connection with twitter
 * in order to store the data for future requests.
 */
	public function twitter(){
		$this->layout = 'ajax';
		$this->autoRender = false;
		$this->loadModel('Customer');
		pr($this->request->query);
		$oauthToken = $this->request->query['oauth_token'];
		$oauthVerifier = $this->request->query['oauth_verifier'];
		$data = $this->Customer->find('first', array('conditions' => array('Customer.oauth_token' => $oauthToken)));
		if ($data != NULL) {
			$oauthTokenSecret = $data['Customer']['oauth_token_secret'];
			$twitteroauth = new TwitterOAuth($this->twitterConfig['key'],
											 $this->twitterConfig['secret'],
											 $oauthToken,
											 $oauthTokenSecret);
			$credentials = $twitteroauth->getAccessToken();
			$data['Customer']['twverified'] = 1;
			$data['Customer']['oauth_token'] = $credentials['oauth_token'];
			$data['Customer']['oauth_token_secret'] = $credentials['oauth_token_secret'];
			$this->Customer->save($data);
		}
		$this->redirect($this->facebookAppUrl);
	}
	
	public function twitter_test() {
		$this->autoRender = false;
		$this->autoLayout = false;
		$this->layout = 'ajax';
		echo "hola";
	}

/**
 * Publish status on behalf of the registered user
 * 
 * @param string $mobile
 * @return string response
 */
	public function publish($mobile = NULL, $message = NULL) {
		$this->autoRender = false;
		$this->autoLayout = false;
		$this->layout = 'ajax';
		$answerMsg = "";
		$msgFailMobile = "Hubo un error procesando el telefono celular.";
		$msgFailMessage = "No se pueden publicar mensajes en blanco.";
		$msgSucessFacebook = "Facebook: SMS publicado con exito. ";
		$msgSucessTwitter = "Twitter: SMS publicado con exito.";
		$msgFailFacebook = "Facebook: No se pudo publicar tu SMS. ";
		$msgDuplicateTwitter = "Twitter: No se puede publicar un duplicado.";
		if ($mobile == NULL || $mobile == "") {
			echo $msgFailMobile;
			return;
		}
		if ($message == NULL || $message == "") {
			echo $msgFailMessage;
			return;
		}
		
		$data = $this->Customer->find('first', array('conditions' => array('Customer.mobile' => $mobile)));
		if ($data != NULL) {
			$facebook = new Facebook($this->facebookConfig);
			$twitteroauth = new TwitterOAuth($this->twitterConfig['key'],
											 $this->twitterConfig['secret'],
											 $data['Customer']['oauth_token'],
											 $data['Customer']['oauth_token_secret']);
			$fbid = $data['Customer']['id'];
			$HttpSocket = new HttpSocket();
			$response = $HttpSocket->get('https://graph.facebook.com/oauth/access_token?client_id='.$this->facebookConfig['appId'].'&client_secret='.$this->facebookConfig['secret'].'&grant_type=client_credentials');
			$response = explode('=', $response);
			$accessToken = $response[1];
			$facebook->setAccessToken($accessToken);
			try {
				$response = $facebook->api('/'.$fbid.'/feed', 'POST',
				                           array('message'=>$message));
				if (isset($response['id'])) {
					$answerMsg = $msgSucessFacebook;
					$data['Customer']['fbcounter'] += 1; 
				}
				else {
					$answerMsg = $msgFailFacebook;
				}
			}
			catch (FacebookApiException $e) {
				//pr($e);
				$answerMsg = $msgFailFacebook;
			}
			$twitteroauth = new TwitterOAuth($this->twitterConfig['key'],
											 $this->twitterConfig['secret'],
											 $data['Customer']['oauth_token'],
											 $data['Customer']['oauth_token_secret']);
			$content = $twitteroauth->get('account/verify_credentials');
			if ($message === $content->status->text) {
				$answerMsg .= $msgDuplicateTwitter;
			}
			else {
				$twitteroauth->post('statuses/update', array('status'=>$message));
				$answerMsg .= $msgSucessTwitter;
				$data['Customer']['twcounter'] += 1;
			}
			$this->Customer->save($data);
			echo $answerMsg;
		}
	}
}
