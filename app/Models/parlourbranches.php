<?php namespace App\Models;

use CodeIgniter\Model;

class ParlourBranches extends Model
{
	protected $table      	= 'branches_users';
    protected $primaryKey 	= 'id';

    protected $returnType     = 'array';

 

 protected $allowedFields = ['user_id','branch_id','created_by','updated_by','created_at','updated_at','deleted_at','status'];

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}