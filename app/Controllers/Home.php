<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $menu = [
            'beranda' => [
                'title' => '<b>BERANDA</b>',
                'link' => base_url(),
                'icon' => 'fa fa-house',
                'aktif' => 'active',
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
                'title' => '<b>SISWA</b>',
                'link' => base_url() . '/mahasiswa',
                'icon' => 'fa-solid fa-users',
                'aktif' => '',
            ],

        ];
        $breadcrumb = ' <div class="col-sm-6">
                                <h1 class="m-0">Beranda</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Beranda</li>
                              
                                </ol>
                            </div>';
        $data['menu'] = $menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "welcome to site";
        $data['selamat_datang'] = "Selamat datang di aplikasi sederhana";
        return view('template/content', $data);
    }
}
