<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCartsTable extends Migration
{
    public function up()
    {
        // Create the carts table
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id'     => [
                'type' => 'INT',
                'null' => false,
            ],
            'product_id'  => [
                'type' => 'INT',
                'null' => false,
            ],
            'quantity'    => [
                'type' => 'INT',
                'null' => false,
                'default' => 1, // Default quantity to 1
            ],
            'created_at'  => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'updated_at'  => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
                'on_update' => 'CURRENT_TIMESTAMP',
            ],
        ]);
        
        // Add primary key
        $this->forge->addKey('id', true);

    

        // Create the table
        $this->forge->createTable('carts');
    }

    public function down()
    {
        // Drop the carts table
        $this->forge->dropTable('carts');
    }
}
