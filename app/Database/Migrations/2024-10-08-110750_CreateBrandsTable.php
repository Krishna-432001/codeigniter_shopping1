<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBrandsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'           => 'INT',
                'unsigned'      => true,
                'auto_increment' => true,
            ],
            'name'          => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'description'   => [
                'type'       => 'TEXT',
                'null'       => true, // Allows null values
            ],
            'created_at'    => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'    => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('brands');
    }

    public function down()
    {
        $this->forge->dropTable('brands');
    }
}
