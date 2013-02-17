<?php
App::uses('AppModel', 'Model');
/**
 * Report Model
 *
 */
class Report extends AppModel {
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
		'mobile' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Sólo caracteres numéricos',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minLength' => array(
				'rule' => array('minLength', 7),
				'message' => 'Introduzca los 7 dígitos'
			),
		),
		'state' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'city' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'rule' => 'email',
			'allowEmpty' => true,
			'message' => 'Dirección de correo inválida'
		),
		'operator' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
