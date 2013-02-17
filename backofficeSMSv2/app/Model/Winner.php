<?php
App::uses('AppModel', 'Model');
/**
 * Winner Model
 *
 */
class Winner extends AppModel {
	
/**
 * gets past winners
 * 
 * @param	int		$exceptionRaffle
 * @return	array 	list of past winners message's id
 */
	public function get_past($exceptionRaffle = null) {
		
		if ($exceptionRaffle == null) {
			$pw = $this->find('all');
		}
		else {
			$pw = $this->find('all', array('conditions' => array('Winner.idraffle NOT' => $exceptionRaffle)));
		}
		$x = 0;
		$pastWinners = array();
		foreach ($pw as $pws) {
			$pastWinners[$x] = $pws['Winner']['idmessage'];
			$x++;
		}
		return $pastWinners;
	}
	
}
