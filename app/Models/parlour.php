<?php namespace App\Models;

use CodeIgniter\Model;

class Parlour extends Model
{
	protected $table      	= 'parlours';
    protected $primaryKey 	= 'id';

    protected $returnType     = 'array';

 

 protected $allowedFields = ['title', 'phone','email','contact_details','created_by','updated_by','created_at','updated_at','deleted_at','status'];

    protected $useSoftDeletes = true;

     protected $validationRules    = [
        'title' 			=> 'required|alpha_numeric_space|min_length[3]',
        'phone' 			=> 'required|numeric|exact_length[11]',
        'email' 			=> 'required|valid_email|is_unique[parlours.email]',   
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}