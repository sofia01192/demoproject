<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Branches extends Migration
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
                        'unique' => true,
                        
                ],
                'phone'       => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '11',
                        'null'           => true,
                ],
                'email'       => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                        
                ],

                'contact_person' =>[
                	'type' =>'VARCHAR',
                	'constraint' =>'255' ,

                ],
                 'address'       => [
                        'type'        => 'VARCHAR',
                        'constraint' =>'255' ,
                        'null'           => true, 
                ],



                'longitude' =>[
                		'type' => 'DECIMAL',
                		'null' => false,
                		'constraint' => '10,6'

                ],
                'latitude' =>[
                		'type' => 'DECIMAL',
                		'null' => false,
                		'constraint' => '10,6'
                ],

                'services' =>[
                		'type' =>'VARCHAR',
                		'constraint' => 255,
                		'null' => false,
                ],
                
                 'parlour_id'          => [
                        'type'           => 'INT',
                        'constraint'     => 11,
                        'unsigned'       => TRUE,
                        'null'           => false,
                        
                ],
                
                'created_by'  => [
                        'type'           => 'INT',
                        'constraint'     => 11,
                        'null'           => true,
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

                // 'deleted_at TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP',
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
        $this->forge->addForeignKey('created_by','users','id','CASCADE','CASCADE');
         $this->forge->addForeignKey('updated_by','users','id','CASCADE','CASCADE');
         $this->forge->addForeignKey('parlour_id','parlours','id','CASCADE','CASCADE');
        $this->forge->createTable('branches');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('branches',TRUE);
	}
}
