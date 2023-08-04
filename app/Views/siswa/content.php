<?php
echo $this->extend('template/index');
echo $this->section('content');
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title_cards; ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php
                if (session()->getFlashdata('success')) {
                ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> succes</h5>
                        <?php echo (session()->getFlashdata('success')); ?>
                    </div>
                <?php
                } ?>

                <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>/mahasiswa/tambah"><i class="fa fa-solid fa-plus"></i>Tambah Siswa</a>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th style="width: 10px">No</th>
                            <th>Id Siswa</th>
                            <th>Nama Siswa</th>
                            <th>Kelas pagi</th>
                            <th>Kelas sore</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data_siswa as $r) {

                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $r['id_siswa']; ?></td>
                                <td><?php echo $r['nama_siswa']; ?></td>
                                <td><?php echo $r['kelas_pagi']; ?></td>
                                <td><?php echo $r['kelas_sore']; ?></td>
                                <td>
                                    <a class="btn btn-xs btn-info" href="<?php echo base_url(); ?>/mahasiswa/edit/<?php echo $r['id_siswa']; ?>"><i class="fa-solid fa-edit"></i></a>
                                    <a class="btn btn-xs btn-danger" href="#" onclick="return hapusConfig(<?php echo $r['id_siswa']; ?>);"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.card -->
    </div>
</div>

<script>
    function hapusConfig(id) {
        Swal.fire({
            title: 'Anda yakin mau menghapus ini?',
            text: "Data akan dihapus secara permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?php echo base_url(); ?>/mahasiswa/hapus/' + id;
            }
        })
    }
</script>
<?php
echo $this->endSection();
