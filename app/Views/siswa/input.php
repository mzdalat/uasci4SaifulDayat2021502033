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

            <form action="<?php echo $action; ?>" method="post" autocomplete="off">
                <div class="card-body">
                    <?php if (validation_errors()) { ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                            <?php echo validation_list_errors() ?>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (session()->getFlashdata('error')) {
                    ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-warning"></i>error</h5>
                            <?php echo (session()->getFlashdata('error')); ?>
                        </div>
                    <?php
                    } ?>
                    <?php echo csrf_field() ?>
                    <?php
                    if (current_url(true)->getSegment(2) == 'edit') {
                    ?>
                        <input type="hidden" name="param" id="param" value="<?php echo $edit_data['id_siswa']; ?>">
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="id_siswa">Id Siswa</label>
                        <input type="text" name="id_siswa" id="id_siswa" value="<?php echo empty(set_value('id_siswa')) ? (empty($edit_data['id_siswa']) ? "" : $edit_data['id_siswa']) : set_value('is_siswa'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" name="nama_siswa" id="nama_siswa" value="<?php echo empty(set_value('nama_siswa')) ? (empty($edit_data['nama_siswa']) ? "" : $edit_data['nama_siswa']) : set_value('nama_siswa'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="kelas_pagi">Kelas Pagi</label>
                        <input type="text" name="kelas_pagi" id="kelas_pagi" value="<?php echo empty(set_value('kelas_pagi')) ? (empty($edit_data['kelas_pagi']) ? "" : $edit_data['kelas_pagi']) : set_value('kelas_pagi'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="kelas_sore">Kelas Sore</label>
                        <input type="text" name="kelas_sore" id="kelas_sore" value="<?php echo empty(set_value('kelas_sore')) ? (empty($edit_data['kelas_sore']) ? "" : $edit_data['kelas_sore']) : set_value('kelas_sore'); ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i>simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
echo $this->endSection();
