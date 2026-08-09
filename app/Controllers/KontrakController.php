<?php

namespace App\Controllers;

use App\Models\KontrakModel;
use App\Models\DebiturModel;
use App\Models\MotorModel;

class KontrakController extends BaseController
{
    protected $model;
    protected $debiturModel;
    protected $motorModel;

    public function __construct()
    {
        $this->model        = new KontrakModel();
        $this->debiturModel = new DebiturModel();
        $this->motorModel   = new MotorModel();
    }

    public function index()
    {
        return view('kontrak/index', [
            'title'   => 'Data Kontrak Kredit',
            'kontrak' => $this->model->getKontrakLengkap(),
        ]);
    }

    public function tambah()
    {
        return view('kontrak/form', [
            'title'      => 'Buat Kontrak Baru',
            'no_kontrak' => $this->model->generateNoKontrak(),
            'debitur'    => $this->debiturModel->orderBy('nama_lengkap')->findAll(),
            'motor'      => $this->motorModel->orderBy('merek')->findAll(),
            'data'       => null,
        ]);
    }

    public function simpan()
    {
        $rules = [
            'debitur_id'    => 'required|integer',
            'motor_id'      => 'required|integer',
            'tenor'         => 'required|integer',
            'dp'            => 'required|numeric',
            'bunga_pertahun'=> 'required|numeric',
            'tgl_mulai'     => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $motor        = $this->motorModel->find($this->request->getPost('motor_id'));
        $dp           = (float) str_replace(['.', ','], ['', '.'], $this->request->getPost('dp'));
        $harga        = (float) $motor['harga_otr'];
        $pinjaman     = $harga - $dp;
        $bunga        = (float) $this->request->getPost('bunga_pertahun');
        $tenor        = (int) $this->request->getPost('tenor');
        $angsuran     = round(($pinjaman + ($pinjaman * $bunga / 100)) / $tenor, 2);
        $tgl_mulai    = $this->request->getPost('tgl_mulai');
        $tgl_selesai  = date('Y-m-d', strtotime("+{$tenor} months", strtotime($tgl_mulai)));

        $this->model->insert([
            'no_kontrak'      => $this->request->getPost('no_kontrak'),
            'debitur_id'      => $this->request->getPost('debitur_id'),
            'motor_id'        => $this->request->getPost('motor_id'),
            'tenor'           => $tenor,
            'dp'              => $dp,
            'jumlah_pinjaman' => $pinjaman,
            'bunga_pertahun'  => $bunga,
            'angsuran_perbulan' => $angsuran,
            'tgl_mulai'       => $tgl_mulai,
            'tgl_selesai'     => $tgl_selesai,
            'status'          => 'aktif',
        ]);

        return redirect()->to('/kontrak')->with('success', 'Kontrak kredit berhasil dibuat!');
    }

    public function edit($id)
    {
        return view('kontrak/form', [
            'title'   => 'Edit Kontrak',
            'data'    => $this->model->getKontrakById($id),
            'debitur' => $this->debiturModel->orderBy('nama_lengkap')->findAll(),
            'motor'   => $this->motorModel->orderBy('merek')->findAll(),
        ]);
    }

    public function update($id)
    {
        $rules = [
            'tenor'          => 'required|integer',
            'dp'             => 'required|numeric',
            'bunga_pertahun' => 'required|numeric',
            'tgl_mulai'      => 'required|valid_date',
            'status'         => 'required|in_list[aktif,selesai]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $kontrak  = $this->model->find($id);
        $motor    = $this->motorModel->find($kontrak['motor_id']);
        $dp       = (float) str_replace(['.', ','], ['', '.'], $this->request->getPost('dp'));
        $harga    = (float) $motor['harga_otr'];
        $pinjaman = $harga - $dp;
        $bunga    = (float) $this->request->getPost('bunga_pertahun');
        $tenor    = (int) $this->request->getPost('tenor');
        $angsuran = round(($pinjaman + ($pinjaman * $bunga / 100)) / $tenor, 2);
        $tgl_mulai   = $this->request->getPost('tgl_mulai');
        $tgl_selesai = date('Y-m-d', strtotime("+{$tenor} months", strtotime($tgl_mulai)));

        $this->model->update($id, [
            'tenor'            => $tenor,
            'dp'               => $dp,
            'jumlah_pinjaman'  => $pinjaman,
            'bunga_pertahun'   => $bunga,
            'angsuran_perbulan'=> $angsuran,
            'tgl_mulai'        => $tgl_mulai,
            'tgl_selesai'      => $tgl_selesai,
            'status'           => $this->request->getPost('status'),
        ]);

        return redirect()->to('/kontrak')->with('success', 'Kontrak berhasil diupdate!');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('/kontrak')->with('success', 'Kontrak berhasil dihapus!');
    }
}
