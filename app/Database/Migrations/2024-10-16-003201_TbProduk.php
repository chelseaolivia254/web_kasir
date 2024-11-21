<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use PHPUnit\Framework\Constraint\Constraint;

class TbProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'produk_id' => [
                'type'  => 'INT',
                'constraint' => '11',
                'unsigned' => 'TRUE',
                'auto_increment' => 'TRUE'
            ],
                'nama_produk' => [
                    'type'    => 'Varchar',
                    'constraint' => '255'
            ],
                'harga' => [
                    'type' => 'decimal',
                    'constraint' => '10,2'
            ],
                'stok' => [
                    'type' => 'INT',
                    'constraint' => '11'
                ],
        ]);
        $this->forge->addKey('produk_id',TRUE);
        $this->forge->createTable('produk_id');
    }

    public function down()
    {
        $this->forge->dropTable('tb_produk');
    }
}
