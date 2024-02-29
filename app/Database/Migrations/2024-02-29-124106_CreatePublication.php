<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePublication extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_publicacion' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_categoria' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'mensaje' => [
                'type' => 'TEXT',
            ],
            'archivo' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
            ],
            'fecha_creacion' => [
                'type' => 'DATE',                
            ], 
            'usuario_creacion' => [
                'type' => 'VARCHAR', 
                'constraint' => 25               
            ], 
            'activo' => [
                'type' => 'INT',
                'constraint' => 2,
            ],        
        ]);
        $this->forge->addKey('id_publicacion', true);
        $this->forge->addForeignKey('id_categoria', 'categorias', 'id_categoria');
        $this->forge->createTable('publicaciones' ,true);
    }

    public function down()
    {        
        $this->forge->dropTable('publicaciones');
    }
}
