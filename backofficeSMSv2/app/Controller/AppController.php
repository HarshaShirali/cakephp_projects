<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $helpers = array('Session', 'Form', 'Html');
	public $components = array(
	    'Session',
	    'Auth' => array(
	      'loginRedirect' => array('controller' => 'users', 'action' => 'main'),
	      'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
	      'authorize' => array('Controller')
	    )
  	);

/**
 * Checks whether a user is admin in order to have access to a controller function.
 * Additional rules are placed inside Controllers' beforeFilter functions.
 * @param	object		$user
 * @return	bool
 */
  public function isAuthorized($user) {
    if (isset($user['role']) && $user['role'] === 'admin') {
      return true;
    }

    // Default deny
    return false;

  }

/**
 * Everything that has to be done before the controller completely loads.
 */
	public function beforeFilter() {
		// So far it's a virtual function.
	}
}
