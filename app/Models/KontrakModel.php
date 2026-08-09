<?php

namespace App\Models;

use CodeIgniter\Model;

class KontrakModel extends Model
{
    protected $table            = 'kontrak';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'no_kontrak', 'debitur_id', 'motor_id', 'tenor', 'dp',
        'jumlah_pinjaman', 'bunga_pertahun', 'angsuran_perbulan',
        'tgl_mulai', 'tgl_selesai', 'status'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    public function generateNoKontrak(): string
    {
        $year = date('Y');
        $last = $this->like('no_kontrak', "KTR-{$year}", 'after')
                     ->orderBy('id', 'DESC')
                     ->first();
        if (!$last) return "KTR-{$year}0001";
        $num = intval(substr($last['no_kontrak'], 8)) + 1;
        return "KTR-{$year}" . str_pad($num, 4, '0', STR_PAD_LEFT);
    }

    public function getKontrakLengkap()
    {
        return $this->db->table('kontrak k')
            ->select('k.*, d.nama_lengkap, d.no_ktp, m.merek, m.tipe, m.tahun, m.warna')
            ->join('debitur d', 'd.id = k.debitur_id')
            ->join('motor m', 'm.id = k.motor_id')
            ->orderBy('k.id', 'DESC')
            ->get()->getResultArray();
    }

    public function getKontrakById($id)
    {
        return $this->db->table('kontrak k')
            ->select('k.*, d.nama_lengkap, d.no_ktp, m.merek, m.tipe, m.tahun, m.warna, m.harga_otr')
            ->join('debitur d', 'd.id = k.debitur_id')
            ->join('motor m', 'm.id = k.motor_id')
            ->where('k.id', $id)
            ->get()->getRowArray();
    }

    public function getKontrakByStatus($status)
    {
        return $this->db->table('kontrak k')
            ->select('k.*, d.nama_lengkap, d.no_ktp, m.merek, m.tipe, m.tahun')
            ->join('debitur d', 'd.id = k.debitur_id')
            ->join('motor m', 'm.id = k.motor_id')
            ->where('k.status', $status)
            ->orderBy('k.id', 'DESC')
            ->get()->getResultArray();
    }
}
