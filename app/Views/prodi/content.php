<?php
echo $this->extend('template/index');
echo $this->section('content');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><?php echo $title_card; ?></h3>
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

        <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>/prodi/tambah"><i class="fa fa-solid fa-plus"></i>Tambah prodi</a>
        <table class="table table-sm">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>Kd Prodi</th>
              <th>Nama Prodi</th>
              <th>Fakultas</th>

              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($data_prodi as $r) {

            ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $r['kdprodi']; ?></td>
                <td><?php echo $r['nama_prodi']; ?></td>
                <td><?php echo $r['falkutas']; ?></td>

                <td>
                  <a class="btn btn-xs btn-info" href="<?php echo base_url(); ?>/prodi/edit/<?php echo $r['kdprodi']; ?>"><i class="fa-solid fa-edit"></i></a>
                  <a class="btn btn-xs btn-danger" href="#" onclick="return hapusConfig(<?php echo $r['kdprodi']; ?>);"><i class="fa-solid fa-trash"></i></a>
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
        window.location.href = '<?php echo base_url(); ?>/prodi/hapus/' + id;
      }
    })
  }
</script>
<?php
echo $this->endSection();
