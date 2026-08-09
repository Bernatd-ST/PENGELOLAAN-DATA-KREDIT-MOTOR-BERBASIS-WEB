<?php

namespace App\Controllers;

use App\Models\DebiturModel;
use App\Models\KontrakModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanController extends BaseController
{
    protected $debiturModel;
    protected $kontrakModel;

    public function __construct()
    {
        $this->debiturModel = new DebiturModel();
        $this->kontrakModel = new KontrakModel();
    }

    public function index()
    {
        return view('laporan/index', ['title' => 'Laporan']);
    }

    public function debitur()
    {
        return view('laporan/debitur', [
            'title'   => 'Laporan Data Debitur',
            'debitur' => $this->debiturModel->orderBy('nama_lengkap')->findAll(),
        ]);
    }

    public function kontrakAktif()
    {
        return view('laporan/kontrak', [
            'title'   => 'Laporan Kontrak Aktif',
            'status'  => 'aktif',
            'kontrak' => $this->kontrakModel->getKontrakByStatus('aktif'),
        ]);
    }

    public function kontrakSelesai()
    {
        return view('laporan/kontrak', [
            'title'   => 'Laporan Kontrak Selesai',
            'status'  => 'selesai',
            'kontrak' => $this->kontrakModel->getKontrakByStatus('selesai'),
        ]);
    }

    public function pdfDebitur()
    {
        $debitur = $this->debiturModel->orderBy('nama_lengkap')->findAll();
        $html    = view('laporan/pdf_debitur', ['debitur' => $debitur]);
        $this->generatePdf($html, 'laporan_debitur_' . date('Ymd') . '.pdf');
    }

    public function pdfAktif()
    {
        $kontrak = $this->kontrakModel->getKontrakByStatus('aktif');
        $html    = view('laporan/pdf_kontrak', ['kontrak' => $kontrak, 'status' => 'Aktif']);
        $this->generatePdf($html, 'laporan_kontrak_aktif_' . date('Ymd') . '.pdf');
    }

    public function pdfSelesai()
    {
        $kontrak = $this->kontrakModel->getKontrakByStatus('selesai');
        $html    = view('laporan/pdf_kontrak', ['kontrak' => $kontrak, 'status' => 'Selesai']);
        $this->generatePdf($html, 'laporan_kontrak_selesai_' . date('Ymd') . '.pdf');
    }

    private function generatePdf($html, $filename)
    {
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename, ['Attachment' => true]);
    }
}
