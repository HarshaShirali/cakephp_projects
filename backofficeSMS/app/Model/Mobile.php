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
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Campo obligatorio',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'namerule' => array(
				'rule' => '/^[a-zÁÉÍÓÚáéíóúÀÈÌÒÙàèìòùÜüÑñ]{2,}(( |[a-zÁÉÍÓÚáéíóúÀÈÌÒÙàèìòùÜüÑñ])[a-zÁÉÍÓÚáéíóúÀÈÌÒÙàèìòùÜüÑñ]+){0,}$/i',
				//en realidad se pudo haber usado \w{2,}( ?\w)* pero no se adminten numeros, so...
				'message' => 'Sólo letras. Mínimo 2 caracteres para primer nombre. Un solo espacio por palabra.'
			),
		),
		'last' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Campo obligatorio',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'namerule' => array(
				'rule' => '/^[a-zÁÉÍÓÚáéíóúÀÈÌÒÙàèìòùÜüÑñ]{2,}(( |[a-zÁÉÍÓÚáéíóúÀÈÌÒÙàèìòùÜüÑñ])[a-zÁÉÍÓÚáéíóúÀÈÌÒÙàèìòùÜüÑñ]+){0,}$/i',
				//en realidad se pudo haber usado \w{2,}( ?\w)* pero no se adminten numeros, so...
				'message' => 'Sólo letras. Mínimo 2 caracteres para primer apellido. Un solo espacio por palabra.'
			),
		),
		'idcard' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Sólo caracteres numéricos',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minLength' => array(
				'rule' => array('minLength', 4),
				'message' => 'Mínimo 4 caracteres'
			),
		),
		'mobile2' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Sólo caracteres numéricos',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minLength' => array(
				'rule' => array('minLength', 7),
				'message' => 'Mínimo 7 caracteres'
			),
		),
		'email' => array(
			'rule' => 'email',
			'allowEmpty' => true,
			'message' => 'Dirección de correo inválida'
		),
	);
	
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

}
