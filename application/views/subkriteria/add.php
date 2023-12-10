<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg mb-4 border-bottom-info">
            <div class="card-header bg-info py-3">
                <div class="row">
                <div class="col-auto">
                        <a href="<?= base_url('datasubkriteria') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="kriteria">Pilih Kriteria penilaian</label>
                    <div class="col-md-6">
                        <select class="form-control" id="kriteria" name="kriteria">
                            <?php foreach ($kriteria as $datakriteria) { ?>
                                <option value='<?php echo $datakriteria['id_kriteria']; ?>'><?php echo $datakriteria['nama_kriteria']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="cu_subkriteria">Kode Alternatif</label>
                    <div class="col-md-6">
                        <input type="text" id="cu_subkriteria" name="cu_subkriteria" class="form-control" placeholder="Masukan Kode Subkriteria">
                        <?= form_error('cu_subkriteria', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="kategori">Kategori</label>
                    <div class="col-md-6">
                        <input type="text" id="kategori" name="kategori" class="form-control" placeholder="Nama Kategori">
                        <?= form_error('kategori', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="bobot">Bobot</label>
                    <div class="col-md-6">
                        <input type="number" id="bobot" name="bobot" class="form-control" placeholder="Nilai">
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
<script>
$(function (){
  $('[data-toggle="tooltip"]').tooltip()

})
</script>