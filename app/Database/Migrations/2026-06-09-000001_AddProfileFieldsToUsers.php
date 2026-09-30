<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProfileFieldsToUsers extends Migration
{
    public function up()
    {
        $fields = [];

        if (!$this->db->fieldExists('alamat', 'users')) {
            $fields['alamat'] = [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'username',
            ];
        }

        if (!$this->db->fieldExists('nomor_hp', 'users')) {
            $fields['nomor_hp'] = [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'alamat',
            ];
        }

        if (!$this->db->fieldExists('photo', 'users')) {
            $fields['photo'] = [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'nomor_hp',
            ];
        }

        if ($fields !== []) {
            $this->forge->addColumn('users', $fields);
        }
    }

    public function down()
    {
        foreach (['photo', 'nomor_hp', 'alamat'] as $field) {
            if ($this->db->fieldExists($field, 'users')) {
                $this->forge->dropColumn('users', $field);
            }
        }
    }
}
