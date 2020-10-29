<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BranchServices extends Migration
{
	public function up()
	{
		$this->forge->addField([
			      'id'          => [
                                                'type'  => 'INT',
                                                'constraint'     => 11,
                                                'unsigned'       => TRUE,
                                                'auto_increment' => TRUE
                        ],
                        'service_id'       => [
                                                'type'           => 'INT',
                                                'constraint'     => 11,
                                                'unsigned'       => TRUE,
                        ],
                        'branch_id'       => [
                                                'type'           => 'INT',
                                                'constraint'     => 11,
                                                'unsigned'       => TRUE,
                        ],

                        'price'         =>[
                                                'type'          =>'FLOAT',
                                                'constraint'    =>255,
                                                'null'          => False

                        ],
                        'duration'      =>[
                                                'type'          => 'TIME',
                                                'null'          => False
                        ],
                
                        'created_by'  => [
                                                'type'           => 'INT',
                                                'constraint'     => 11,
                        
                                                'unsigned'       => TRUE,
                        ],
                         'updated_by'  => [
                                                'type'           => 'INT',
                                                'constraint'     => 11,
                                
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
                $this->forge->addForeignKey('service_id','services','id','CASCADE','CASCADE');
                $this->forge->addForeignKey('branch_id','branches','id','CASCADE','CASCADE');
                $this->forge->createTable('branch_services');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('branch_services',TRUE);

	}
}
