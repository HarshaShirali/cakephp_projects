<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller', 'Datasource');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display() {
		$facebook = new Facebook($this->facebookConfig);
		$user = $facebook->getUser();
		//$token = $facebook->getAccessToken();
		if ($user == 0) {
			// we go the padawan path (initialization)
			$this->layout = 'ajax';
			$this->set('padawan', TRUE);
			$params = array('scope' => 'publish_stream, publish_actions, email, user_birthday',
							'redirect_uri' => $this->facebookAppUrl);
			$this->set('facebookUrl', $facebook->getLoginUrl($params));
		}
		else {
			$this->loadModel('Customer');
			$data = $this->Customer->find('all', array('conditions'=>array('Customer.id'=>$user)));
			$me = $facebook->api('/me');
			$signedRequest = $facebook->getSignedRequest();
			if ($data == NULL) {
				$data = array('Customer'=>array());
				$data['Customer']['id'] = $user;
				if (isset($me['email'])) { $data['Customer']['email'] = $me['email']; }
				if (isset($me['name'])) { $data['Customer']['name'] = $me['name']; }
				if (isset($me['gender'])) { $data['Customer']['gender'] = $me['gender']; }
				if (isset($me['birthday'])) {
					$data['Customer']['birthday'] = $this->Customer->convertFbBirthday($me['birthday']);
				}
				if (isset($signedRequest['user']['country'])) {
					$data['Customer']['fbcountry'] = $signedRequest['user']['country'];
				}
				//$data['Customer']['datecreated'] = date('Y-m-d H:i:s');
				$data['Customer']['datecreated'] = DboSource::expression('NOW()');
				$this->Customer->create();
				$this->Customer->save($data);	
			}
			$this->set('facebookUrl', $this->facebookAppUrl);
			$this->redirect(array('controller'=>'customers', 'action'=>'index'));
		}
		
		$path = func_get_args();
		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}

}
