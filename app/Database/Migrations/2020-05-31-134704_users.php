<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([
                'id'          => [
                        'type'           => 'INT',
                        'constraint'     => 11,
                        'unsigned'       => TRUE,
                        'auto_increment' => TRUE
                ],
                'title'       => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                        
                ],
                'telephone'       => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '50',
                        'null'           => true,
                ],
                'email'       => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                        'unique' => true,
                ],
                'password'       => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '32',
                        'null'           => true,
                ],
                'profile_photo'       => [
                        'type'           => 'text',
                        'null'           => true,                        
                ],
                'address'       => [
                        'type'           => 'text',
                        'null'           => true, 
                ],
                'identity_no'       => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '15',
                        'null'           => true, 
                ],
                'verification_code'       => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                        'null'           => true, 
                ],
                'city_id'       => [
                        'type'           => 'INT',
                        'constraint'     => 11,
                        'unsigned'       => TRUE,
                        'null'           => true, 
                ],
                'country_id'       => [
                        'type'           => 'INT',
                        'constraint'     => 11,
                        'unsigned'       => TRUE,
                        'null'           => true, 
                ],



                'created_by'  => [
                        'type'           => 'INT',
                        'constraint'     => 11,
                        'null'           => true,
                ],
                'updated_by'  => [
                        'type'           => 'INT',
                        'constraint'     => 11,
                        'null'           => true,
                ],
                'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'deleted_at' =>[
                        'type'           => 'datetime',
                        'null'           => true,
                ],
                'status'  => [
                        'type'           => 'char',
                        'constraint'     => 1,
                        'DEFAULT'       =>'1',
                        
                ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
