<?php namespace App\Models;

use CodeIgniter\Model;

class Service extends Model
{
	protected $table      	= 'services';
    protected $primaryKey 	= 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}