<?php namespace App\Models;

use CodeIgniter\Model;

class Userrole extends Model
{
	protected $table      	= 'userroles';
    protected $primaryKey 	= 'id';

    protected $returnType     = 'array';


     protected $allowedFields = ['title', 'created_by','updated_by','status'];
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}