<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdiModel;
use App\Models\SemesterModel;

class semester extends BaseController
{
    protected $pm;
    private   $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new SemesterModel();
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
                'aktif' => 'active',
            ],
            'semester' => [
                'title' => '<b>SEMESTER</b>',
                'link' => base_url() . '/semester',
                'icon' => 'fa-solid fa-list',
                'aktif' => '',
            ],
            'mahasiswa' => [
                'title' => '<b>MAHASISWA</b>',
                'link' => base_url() . '/mahasiswa',
                'icon' => 'fa-solid fa-users',
                'aktif' => '',
            ],

        ];
        $this->rules = [
            'kd_semester' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kode semester tidak boleh kosong',
                ]
            ],
            'semesters' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama semester tidak boleh kosong',
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
                                <h1 class="m-0">semester</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="' . base_url() . '"> Beranda</a></li>
                                    <li class="breadcrumb-item active">Semester</li>
                              
                                </ol>
                            </div>';
        $data['breadcrumb'] = $breadcrumb;
        $data['menu'] = $this->menu;
        $data['title_cards'] = "Data Semester";

        $query = $this->pm->find();
        $data['data_semester'] = $query;
        return view('semester/content', $data);
    }
    public function tambah()
    {
        $breadcrumb = ' <div class="col-sm-6">
                                <h1 class="m-0">Semester</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="' . base_url() . '"> Beranda</a></li>
                                    <li class="breadcrumb-item"><a href="' . base_url() . '/semester"> semester</a></li>
                                    <li class="breadcrumb-item active">Tambah Semester</li>
                              
                                </ol>
                            </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_cards'] = 'Tambah Semester';
        $data['action'] = base_url() . '/semester/simpan';
        return view('semester/input', $data);
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



            return redirect()->to('semester')->with('success', 'data berhasil disimpan');
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
            return redirect()->to('semester')->with('success', 'Data semester dengan data' . $id . 'berhasil di hapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('semester')->with('error', $e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = ' <div class="col-sm-6">
                                <h1 class="m-0">semester</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="' . base_url() . '"> Beranda</a></li>
                                    <li class="breadcrumb-item"><a href="' . base_url() . '/semester"> Semester</a></li>
                                    <li class="breadcrumb-item active">Edit Semester</li>
                              
                                </ol>
                            </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_cards'] = 'Edit Semester';
        $data['action'] = base_url() . '/semester/update';

        $data['edit_data'] = $this->pm->find($id);

        return view('semester/input', $data);
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
            return redirect()->to('semester')->with('success', 'data berhasil diedit');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
