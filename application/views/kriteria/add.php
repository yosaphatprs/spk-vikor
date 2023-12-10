<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg mb-4 border-bottom-info">
            <div class="card-header bg-info py-3">
                <div class="row">
                <div class="col-auto">
                        <a href="<?= base_url('datakriteria') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon" data-toggle="tooltip" title="Kembali">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                        </a>
                    </div>
                    <div class="col">
                    <h4 class="h5 align-middle m-0 font-weight-bold text-light text-center">
                            Form <?= $title; ?>
                    </h4>
                </div>
            </div>
        </div>
            <div class="card-body pb-2">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(); ?>
                <input value="<?php echo $kode; ?>" type="text" id="id_kriteria" name="id_kriteria" class="form-control" placeholder="Kode Kriteria" hidden>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="nama_kriteria">Nama Kriteria</label>
                    <div class="col-md-6">
                        <input type="text" id="nama_kriteria" name="nama_kriteria" class="form-control" placeholder="Nama Kriteria">
                        <?= form_error('nama_kriteria', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="bobot">Bobot</label>
                    <div class="col-md-6">
                        <input autocomplete="off" type="number" step="0.01" id="bobot" name="bobot" class="form-control" placeholder="Nilai">
                        <?= form_error('bobot', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <br>
                <div class="row form-group justify-content-end">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-success">
                            <span>Simpan</span>
                        </button>
                        <button type="reset" class="btn btn-warning">
                            <span>Reset</span>
                        </button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>