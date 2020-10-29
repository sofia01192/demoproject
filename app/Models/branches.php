<?php namespace App\Models;

use CodeIgniter\Model;

class Branches extends Model
{
	protected $table      	= 'branches';
    protected $primaryKey 	= 'id';

    protected $returnType     = 'array';

 

 protected $allowedFields = ['title', 'phone','email','contact_person','address','longitude','latitude','services','parlour_id','created_by','updated_by','created_at','updated_at','deleted_at','status'];

    protected $useSoftDeletes = true;

    protected $validationRules    = [
        'title' 			=> 'required|alpha_numeric_space|min_length[4]|is_unique[branches.title]',
        'phone' 			=> 'required|numeric|exact_length[11]',
        'email' 			=> 'required|valid_email',
        'contact_person'	=> 'required|alpha_space',
        'address' 			=> 'required|max_length[150]',  
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}