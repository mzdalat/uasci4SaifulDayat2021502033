<?php

namespace App\Models;

use CodeIgniter\Model;

class SemesterModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'semester';
    protected $primaryKey       = 'kd_semester';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['kd_semester', 'semesters', 'password'];



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
