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
                        <input type="hidden" name="param" id="param" value="<?php echo $edit_data['kd_semester']; ?>">
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="kd_semester">Kode Semester</label>
                        <input type="text" name="kd_semester" id="kd_semester" value="<?php echo empty(set_value('kd_semester')) ? (empty($edit_data['kd_semester']) ? "" : $edit_data['kd_semester']) : set_value('kd_semester'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="semesters">Nama Semester</label>
                        <input type="text" name="semesters" id="semesters" value="<?php echo empty(set_value('semesters')) ? (empty($edit_data['semesters']) ? "" : $edit_data['semesters']) : set_value('semesters'); ?>" class="form-control">
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
