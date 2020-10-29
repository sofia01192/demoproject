<?php namespace App\Models;

use CodeIgniter\Model;

class Faq extends Model
{
	protected $table      	= 'faqs';
    protected $primaryKey 	= 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}