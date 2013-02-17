<?php
App::uses('AppModel', 'Model');
/**
 * Message Model
 *
 */
class Message extends AppModel {
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
		'mobile' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'idnumber' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
}
