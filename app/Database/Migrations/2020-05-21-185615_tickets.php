<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tickets extends Migration
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
                        'message'       => [
                                'type'           => 'text'
                        ],
                        'ticketcategory_id' => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                        ],
                        'ticketpriority_id' => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                        ],
                        'ticketstatus_id' => [
                                'type'           => 'INT',
                                'constraint'     => 11,
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
                        ],
                ]);

                $this->forge->addKey('id', TRUE);
                $this->forge->createTable('tickets');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tickets');
	}
}
