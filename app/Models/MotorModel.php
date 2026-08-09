<?php

namespace App\Models;

use CodeIgniter\Model;

class MotorModel extends Model
{
    protected $table            = 'motor';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'id_motor', 'merek', 'tipe', 'tahun', 'warna', 'harga_otr'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    public function generateIdMotor(): string
    {
        $last = $this->orderBy('id', 'DESC')->first();
        if (!$last) return 'MTR-0001';
        $num = intval(substr($last['id_motor'], 4)) + 1;
        return 'MTR-' . str_pad($num, 4, '0', STR_PAD_LEFT);
    }
}
