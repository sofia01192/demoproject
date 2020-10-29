<?php namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
	protected $table      	= 'users';
    protected $primaryKey 	= 'id';

    protected $returnType     = 'array';

 
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];


    protected function beforeInsert(array $data)
    {
     $data = $this->passwordmd5($data);
     return $data;
    }

     protected function beforeUpdate(array $data)
    {
     $data = $this->passwordmd5($data);
     return $data;
    }



     public function passwordmd5(array $data)
     {
        if(isset($data['data']['password']))
        {
          $data['data']['password'] = md5($data['data']['password']);
        }
        
      
        return $data;
     }







    protected $allowedFields = ['title', 'telephone','email','password','address','identity_no'];

    protected $useSoftDeletes = true;

    protected $validationRules    = [
        'title'     => 'required|alpha_numeric_space|min_length[4]',
        'telephone' => 'required|numeric|exact_length[11]',
        'email'        => 'required|valid_email|is_unique[users.email]',
        'password'=>    'required|min_length[8]|max_length[32]',
        
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}