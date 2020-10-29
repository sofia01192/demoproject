<?php namespace App\Models;

use CodeIgniter\Model;

class UserUserrole extends Model
{
	protected $table      	= 'users_userroles';
    protected $primaryKey 	= 'id';

    protected $returnType     = 'object';


     protected $allowedFields = ['user_id','userrole_id' ,'created_by','updated_by','status'];
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}