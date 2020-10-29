<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
		
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	// public $branchValidate = [
 //       'title' 			=> 'required|alpha_numeric_space|min_length[4]',
 //        'phone' 			=> 'required|numeric|exact_length[11]',
 //        'email' 			=> 'required|valid_email|is_unique[branches.email]',
 //        'contact_person	'	=>'required|alpha_space|max_length[40]|is_unique[users.title]',
 //        'address' 			=>'required|alpha_numeric_space|max_length[150]',
 //        'services'			=>'',
 //    ];


	//--------------------------------------------------------------------
}
