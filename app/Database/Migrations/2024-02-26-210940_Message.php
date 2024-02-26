<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Message extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_mensaje' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'dni_emisor' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
            ],
            'mensaje' => [
                'type' => 'TEXT',
            ],
            'dni_receptor' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
            ],
            'fecha_creacion' => [
                'type' => 'DATE',                
            ], 
            'activo' => [
                'type' => 'INT',
                'constraint' => 2,
            ],        
        ]);
        $this->forge->createTable('mensajes' ,true);
    }
    public function down()
    {
        $this->forge->dropTable('mensajes');
    }
}
