<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id'=>[
                'type' => 'INT',
                'unsigned' =>true,
                'auto_increment' =>true,
            ],
            'name'=>[
                'type'=>'VARCHAR',
                'Constraint'=>'255',
            ],
            'username'=>[
                'type'=>'VARCHAR',
                'Constraint'=>'255',
            ],
            'email'=>[
                'type'=>'VARCHAR',
                'Constraint'=>'255',
            ],
            'password'=>[
                'type'=>'VARCHAR',
                'Constraint'=>'255',
            ],
            'picture' =>[
               'type'=>'VARCHAR',
               'Constraint'=>'255',
               'null'=>true,
            ],
            'bio'=>[
                'type'=>'TEXT',
                'null'=>true,
            ],
            'created_at timestamp default current_timestamp',
            'created_at timestamp default current_timestamp on update current_timestamp'




        ]);

        $this->forge->addkey('id',true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
