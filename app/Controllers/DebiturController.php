<?php

namespace App\Controllers;

use App\Models\DebiturModel;

class DebiturController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new DebiturModel();
    }

    public function index()
    {
        return view('debitur/index', [
            'title'   => 'Data Debitur',
            'debitur' => $this->model->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function tambah()
    {
        return view('debitur/form', [
            'title'      => 'Tambah Debitur',
            'id_debitur' => $this->model->generateIdDebitur(),
            'data'       => null,
        ]);
    }

    public function simpan()
    {
        $rules = [
            'nama_lengkap' => 'required|min_length[3]',
            'no_ktp'       => 'required|exact_length[16]|is_unique[debitur.no_ktp]',
            'alamat'       => 'required',
            'no_hp'        => 'required|min_length[10]',
            'pekerjaan'    => 'required',
            'penghasilan'  => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert([
            'id_debitur'   => $this->request->getPost('id_debitur'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'no_ktp'       => $this->request->getPost('no_ktp'),
            'alamat'       => $this->request->getPost('alamat'),
            'no_hp'        => $this->request->getPost('no_hp'),
            'pekerjaan'    => $this->request->getPost('pekerjaan'),
            'penghasilan'  => str_replace(['.', ','], ['', '.'], $this->request->getPost('penghasilan')),
        ]);

        return redirect()->to('/debitur')->with('success', 'Data debitur berhasil ditambahkan!');
    }

    public function edit($id)
    {
        return view('debitur/form', [
            'title' => 'Edit Debitur',
            'data'  => $this->model->find($id),
        ]);
    }

    public function update($id)
    {
        $data = $this->model->find($id);

        $rules = [
            'nama_lengkap' => 'required|min_length[3]',
            'no_ktp'       => 'required|exact_length[16]|is_unique[debitur.no_ktp,id,' . $id . ']',
            'alamat'       => 'required',
            'no_hp'        => 'required|min_length[10]',
            'pekerjaan'    => 'required',
            'penghasilan'  => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'no_ktp'       => $this->request->getPost('no_ktp'),
            'alamat'       => $this->request->getPost('alamat'),
            'no_hp'        => $this->request->getPost('no_hp'),
            'pekerjaan'    => $this->request->getPost('pekerjaan'),
            'penghasilan'  => str_replace(['.', ','], ['', '.'], $this->request->getPost('penghasilan')),
        ]);

        return redirect()->to('/debitur')->with('success', 'Data debitur berhasil diupdate!');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('/debitur')->with('success', 'Data debitur berhasil dihapus!');
    }
}
