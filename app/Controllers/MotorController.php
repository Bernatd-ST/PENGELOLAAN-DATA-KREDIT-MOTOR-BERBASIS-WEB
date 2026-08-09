<?php

namespace App\Controllers;

use App\Models\MotorModel;

class MotorController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new MotorModel();
    }

    public function index()
    {
        return view('motor/index', [
            'title' => 'Data Motor',
            'motor' => $this->model->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function tambah()
    {
        return view('motor/form', [
            'title'    => 'Tambah Motor',
            'id_motor' => $this->model->generateIdMotor(),
            'data'     => null,
        ]);
    }

    public function simpan()
    {
        $rules = [
            'merek'     => 'required',
            'tipe'      => 'required',
            'tahun'     => 'required|integer|min_length[4]|max_length[4]',
            'warna'     => 'required',
            'harga_otr' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert([
            'id_motor'  => $this->request->getPost('id_motor'),
            'merek'     => $this->request->getPost('merek'),
            'tipe'      => $this->request->getPost('tipe'),
            'tahun'     => $this->request->getPost('tahun'),
            'warna'     => $this->request->getPost('warna'),
            'harga_otr' => str_replace(['.', ','], ['', '.'], $this->request->getPost('harga_otr')),
        ]);

        return redirect()->to('/motor')->with('success', 'Data motor berhasil ditambahkan!');
    }

    public function edit($id)
    {
        return view('motor/form', [
            'title' => 'Edit Motor',
            'data'  => $this->model->find($id),
        ]);
    }

    public function update($id)
    {
        $rules = [
            'merek'     => 'required',
            'tipe'      => 'required',
            'tahun'     => 'required|integer|min_length[4]|max_length[4]',
            'warna'     => 'required',
            'harga_otr' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, [
            'merek'     => $this->request->getPost('merek'),
            'tipe'      => $this->request->getPost('tipe'),
            'tahun'     => $this->request->getPost('tahun'),
            'warna'     => $this->request->getPost('warna'),
            'harga_otr' => str_replace(['.', ','], ['', '.'], $this->request->getPost('harga_otr')),
        ]);

        return redirect()->to('/motor')->with('success', 'Data motor berhasil diupdate!');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('/motor')->with('success', 'Data motor berhasil dihapus!');
    }
}
