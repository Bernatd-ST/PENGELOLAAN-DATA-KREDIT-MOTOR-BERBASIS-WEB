<?php

namespace App\Controllers;

use App\Models\DebiturModel;
use App\Models\MotorModel;
use App\Models\KontrakModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $debiturModel = new DebiturModel();
        $motorModel   = new MotorModel();
        $kontrakModel = new KontrakModel();

        $data = [
            'title'           => 'Dashboard',
            'total_debitur'   => $debiturModel->countAll(),
            'total_motor'     => $motorModel->countAll(),
            'total_aktif'     => $kontrakModel->where('status', 'aktif')->countAllResults(),
            'total_selesai'   => $kontrakModel->where('status', 'selesai')->countAllResults(),
            'kontrak_terbaru' => $kontrakModel->getKontrakLengkap(),
        ];

        return view('dashboard/index', $data);
    }
}
