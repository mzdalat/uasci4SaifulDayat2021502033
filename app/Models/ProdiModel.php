<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'prodi';
    protected $primaryKey       = 'kdprodi';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['kdprodi', 'nama_prodi', 'falkutas', 'password'];



    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }
}
