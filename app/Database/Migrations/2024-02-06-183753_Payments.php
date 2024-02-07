<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'payment_type_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'currency_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['Income', 'Expense'],
            ],
            'feedback' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('payment_type_id', 'payment_types', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('currency_id', 'currencies', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payments');
    }

    public function down()
    {
        $this->forge->dropTable('payments');
    }
}
