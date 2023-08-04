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
                        <input type="hidden" name="param" id="param" value="<?php echo $edit_data['kdprodi']; ?>">
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="nama_prodi">Kode Prodi</label>
                        <input type="text" name="kdprodi" id="kdprodi" value="<?php echo empty(set_value('kdprodi')) ? (empty($edit_data['kdprodi']) ? "" : $edit_data['kdprodi']) : set_value('kdprodi'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama_prodi">Nama Prodi</label>
                        <input type="text" name="nama_prodi" id="nama_prodi" value="<?php echo empty(set_value('nama_prodi')) ? (empty($edit_data['nama_prodi']) ? "" : $edit_data['nama_prodi']) : set_value('nama_prodi'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="falkutas">Fakultas</label>
                        <input type="text" name="falkutas" id="falkutas" value="<?php echo empty(set_value('falkutas')) ? (empty($edit_data['falkutas']) ? "" : $edit_data['falkutas']) : set_value('falkutas'); ?>" class="form-control">
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
