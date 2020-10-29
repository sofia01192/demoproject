<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Parlours extends Migration
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
                'phone'       => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '11',
                        'null'           => true,
                ],
                'email'       => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                        'unique' => true,
                ],

                'contact_details' =>[
                	'type' =>'VARCHAR',
                	'constraint' =>'255' ,

                ],

                'created_by'  => [
                        'type'           => 'INT',
                        'constraint'     => 11,
                        'unsigned'       => TRUE,
                        
                ],
                'updated_by'  => [
                        'type'           => 'INT',
                        'constraint'     => 11,
                        'null'           => true,
                        'unsigned'       => TRUE,
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
        //$this->forge->addForeignKey('userrole_id','userroles','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('created_by','users','id','CASCADE','CASCADE');
         $this->forge->addForeignKey('updated_by','users','id','CASCADE','CASCADE');
        $this->forge->createTable('parlours');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('parlours',TRUE);
	}
}
