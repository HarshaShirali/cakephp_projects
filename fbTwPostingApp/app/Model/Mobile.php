<?php
App::uses('AppModel', 'Model');
/**
 * Mobile Model
 *
 */
class Mobile extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	
/**
 * Parse the mobile number from the format stored in server
 * to the standard format. Eg: 1585343434 > 04165343434
 * 
 * @param string	mobile number in server
 * @return string	mobile number publicly
 */	
	public function get_normal($mobile) {
		$prefix = substr($mobile, 0, 3);
		$mobile = substr($mobile, 3, strlen($mobile));
		if ($prefix == '158')
			$mobile = '0416'.$mobile;
		elseif ($prefix == '199')
			$mobile = '0426'.$mobile;
		elseif ($prefix == '584')
			$mobile = '04'.$mobile;
		else
			$mobile = $prefix.$mobile;
		return $mobile;
	}

/**
 * Parse the mobile number from the format stored in server
 * to the standard format. Eg: 1585343434 > 04165343434
 * 
 * @param string	mobile number in server
 * @return string	mobile number publicly
 */	
	public function get_server($mobile) {
		$prefix = substr($mobile, 0, 3);
		$mobile = substr($mobile, 3, strlen($mobile));
		if ($prefix == '0416')
			$mobile = '158'.$mobile;
		elseif ($prefix == '0426')
			$mobile = '199'.$mobile;
		elseif ($prefix == '0412')
			$mobile = '58'.$mobile;
		else
			$mobile = $prefix.$mobile;
		return $mobile;
	}
/**
 * Returns the operator prefix from the mobile number.
 * Take into consideration that the operator is NOT
 * converted, just returned as is.
 * @param string $mobile
 * @return string
 */
	public function get_operator($mobile) {
		$prefix = substr($mobile, 0, 3);
		switch ($prefix) {
			case '158':
			case '199':
				return $prefix;
			case '584':
				return '58412';
		}
		return substr($mobile, 0, 4);
	}

/**
 * Returns the mobile number without the operator.
 * @param string $mobile
 * @return string
 */
	public function no_operator($mobile) {
		$operator = $this->get_operator($mobile);
		$mobile = explode($operator, $mobile);
		return $mobile[1]; 
	}

}
