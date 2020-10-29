<?php namespace App\Models;

use CodeIgniter\Model;

class Ticketcategory extends Model
{
	protected $table      	= 'ticketcategories';
    protected $primaryKey 	= 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}