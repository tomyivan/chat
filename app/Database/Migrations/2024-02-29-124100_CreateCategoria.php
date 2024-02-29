<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoria extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_categoria' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'detalle' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
            ],
            'activo' => [
                'type' => 'INT',
                'constraint' => 2,
            ],        
        ]);
        $this->forge->addKey('id_categoria', true);
        $this->forge->createTable('categorias' ,true);
    }

    public function down()
    {
        $this->forge->dropTable('categorias');
    }
}
