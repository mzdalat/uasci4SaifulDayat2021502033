<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdiModel;
use App\Models\SemesterModel;
use App\Models\SiswaModel;

class mahasiswa extends BaseController
{
    protected $pm;
    private   $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new SiswaModel();
        $this->menu = [
            'beranda' => [
                'title' => '<b>BERANDA</b>',
                'link' => base_url(),
                'icon' => 'fa fa-house',
                'aktif' => '',
            ],
            'prodi' => [
                'title' => '<b>JURUSAN</b>',
                'link' => base_url() . '/prodi',
                'icon' => 'fa-solid fa-building-columns',
                'aktif' => '',
            ],
            'semester' => [
                'title' => '<b>SEMESTER</b>',
                'link' => base_url() . '/semester',
                'icon' => 'fa-solid fa-list',
                'aktif' => '',
            ],
            'mahasiswa' => [
                'title' => '<b>SISWA</B>',
                'link' => base_url() . '/mahasiswa',
                'icon' => 'fa-solid fa-users',
                'aktif' => 'active',
            ],

        ];
        $this->rules = [
            'id_siswa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kode siswa tidak boleh kosong',
                ]
            ],
            'nama_siswa' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama siswa tidak boleh kosong',
                ]
            ],
            'kelas_pagi' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama siswa tidak boleh kosong',
                ]
            ],
            'kelas_sore' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama siswa tidak boleh kosong',
                ]
            ],

            'password' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'password  tidak boleh kosong',
                ]
            ],

        ];
    }

    public function index()
    {

        $breadcrumb = ' <div class="col-sm-6">
                                <h1 class="m-0">siswa</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="' . base_url() . '"> Beranda</a></li>
                                    <li class="breadcrumb-item active">Siswa</li>
                              
                                </ol>
                            </div>';
        $data['breadcrumb'] = $breadcrumb;
        $data['menu'] = $this->menu;
        $data['title_cards'] = "Data Siswa";

        $query = $this->pm->find();
        $data['data_siswa'] = $query;
        return view('siswa/content', $data);
    }
    public function tambah()
    {
        $breadcrumb = ' <div class="col-sm-6">
                                <h1 class="m-0">siswa</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="' . base_url() . '"> Beranda</a></li>
                                    <li class="breadcrumb-item"><a href="' . base_url() . '/mahasiswa"> siswa</a></li>
                                    <li class="breadcrumb-item active">Tambah Siswa</li>
                              
                                </ol>
                            </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_cards'] = 'Tambah Siswa';
        $data['action'] = base_url() . '/mahasiswa/simpan';
        return view('siswa/input', $data);
    }
    public function simpan()
    {

        if (strtolower($this->request->getMethod()) !== 'post') {


            return redirect()->back()->withInput();
        }
        if (!$this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }
        $dt = $this->request->getPost();
        try {
            $simpan = $this->pm->insert($dt);



            return redirect()->to('mahasiswa')->with('success', 'data berhasil disimpan');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    public function hapus($id)
    {
        if (empty($id)) {
            return redirect()->back()->with('error', 'hapus data gagal di lakukan');
        }
        try {
            $this->pm->delete($id);
            return redirect()->to('mahasiswa')->with('success', 'Data siswa dengan data-' . $id . '-berhasil di hapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('mahasiswa')->with('error', $e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = ' <div class="col-sm-6">
                                <h1 class="m-0">siswa</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="' . base_url() . '"> Beranda</a></li>
                                    <li class="breadcrumb-item"><a href="' . base_url() . '/mahasiswa"> Siswa</a></li>
                                    <li class="breadcrumb-item active">Edit Siswa</li>
                              
                                </ol>
                            </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_cards'] = 'Edit Siswa';
        $data['action'] = base_url() . '/mahasiswa/update';

        $data['edit_data'] = $this->pm->find($id);

        return view('siswa/input', $data);
    }

    public function update()
    {
        $dtEdit = $this->request->getPost();
        $param = $dtEdit['param'];
        unset($dtEdit['param']);
        unset($this->rules['password']);


        if (!$this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }
        if (empty($dtEdit['password'])) {
            unset($dtEdit['password']);
        }
        try {
            $this->pm->update($param, $dtEdit);
            return redirect()->to('mahasiswa')->with('success', 'data berhasil diedit');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
