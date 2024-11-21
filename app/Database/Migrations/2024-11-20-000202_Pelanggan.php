<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelanggan' => [
                'type'  => 'INT',
                'constraint' => '11',
                'unsigned' => 'TRUE',
                'auto_increment' => 'TRUE'
            ],
                'nama_pelanggan' => [
                    'type'    => 'VARCHAR',
                    'constraint' => '255'
            ],
                'alamat' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255'
            ],
                'nomor_telepon' => [
                    'type' => 'INT',
                    'constraint' => '11'
            ],
            
        ]);
        $this->forge->addKey('id_pelanggan',TRUE);
        $this->forge->createTable('tb_pelanggan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_pelanggan');
    }
}
