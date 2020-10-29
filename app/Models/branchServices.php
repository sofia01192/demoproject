<?php namespace App\Models;

use CodeIgniter\Model;

class BranchServices extends Model
{
	protected $table      	= 'branch_services';
    protected $primaryKey 	= 'id';

    protected $returnType     = 'array';


    protected $allowedFields = ['service_id','branch_id' ,'price','duration','created_by','updated_by','status'];
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}