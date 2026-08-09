<?php

namespace App\Models;

use CodeIgniter\Model;

class DebiturModel extends Model
{
    protected $table            = 'debitur';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'id_debitur', 'nama_lengkap', 'no_ktp', 'alamat',
        'no_hp', 'pekerjaan', 'penghasilan'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    public function generateIdDebitur(): string
    {
        $last = $this->orderBy('id', 'DESC')->first();
        if (!$last) return 'DBT-0001';
        $num = intval(substr($last['id_debitur'], 4)) + 1;
        return 'DBT-' . str_pad($num, 4, '0', STR_PAD_LEFT);
    }
}
