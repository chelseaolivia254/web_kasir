<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelangganModel;

class Pelanggan extends BaseController
{
    protected $pelangganModel;

    public function __construct()
    {
        $this->pelangganModel = new PelangganModel();
    }

    public function index()
    {
        return view('data_pelanggan/v_pelanggan');
    }

    public function simpan_pelanggan()
    {
        // Validasi input dari AJAX
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_pelanggan'   => 'required',
            'alamat'           => 'required',
            'nomor_telepon'    => 'required|integer',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status'    => 'error',
                'errors'    => $validation->getErrors(),
            ]);
        }

        $data = [
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'alamat'         => $this->request->getVar('alamat'),
            'nomor_telepon'  => $this->request->getVar('nomor_telepon'),
        ];

        $this->pelangganModel->save($data);

        return $this->response->setJSON([
            'status'    => 'success',
            'message'   => 'Data pelanggan berhasil disimpan',
        ]);
    }

    public function tampil_pelanggan()
    {
        $pelanggan = $this->pelangganModel->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'pelanggan' => $pelanggan
        ]);
    }

    public function getPelanggan($id)
    {
        $pelanggan = $this->pelangganModel->find($id);

        if ($pelanggan) {
            return $this->response->setJSON([
                'status' => 'success',
                'pelanggan' => $pelanggan
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Pelanggan tidak ditemukan'
            ]);
        }
    }

    public function update_pelanggan($id)
    {
        // Validasi input dari AJAX
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_pelanggan'   => 'required',
            'alamat'           => 'required',
            'nomor_telepon'    => 'required|integer',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status'    => 'error',
                'errors'    => $validation->getErrors(),
            ]);
        }

        // Ambil data dari request
        $data = [
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'alamat'         => $this->request->getVar('alamat'),
            'nomor_telepon'  => $this->request->getVar('nomor_telepon'),
        ];

        // Cek apakah pelanggan dengan ID tersebut ada
        $pelanggan = $this->pelangganModel->find($id);

        if (!$pelanggan) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Pelanggan tidak ditemukan',
            ]);
        }

        // Update data pelanggan
        $this->pelangganModel->update($id, $data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Data pelanggan berhasil diperbarui',
        ]);
    }

    public function hapus_pelanggan($id)
    {
        // Cek apakah pelanggan dengan ID tersebut ada
        $pelanggan = $this->pelangganModel->find($id);

        if (!$pelanggan) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Pelanggan tidak ditemukan',
            ]);
        }

        // Hapus pelanggan
        $this->pelangganModel->delete($id);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Pelanggan berhasil dihapus',
        ]);
    }
}
