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
                        <h4 class="h5 align-middle m-0 font-weight-bold text-white text-center">
                            Form <?= $title; ?>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body pb-2">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(); ?>
                <input value="<?php echo $subkriteria[0]['id_subkriteria']; ?>" type="text" id="id_subkriteria" name="id_subkriteria" class="form-control" placeholder="Kode Subkriteria" hidden>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="kriteria">Pilih Kriteria</label>
                    <div class="col-md-6">
                        <select class="form-control" id="kriteria" name="kriteria">
                            <?php foreach ($kriteria as $datakriteria) { ?>
                                <option value='<?php echo $datakriteria['id_kriteria']; ?>' <?php if ($datakriteria['id_kriteria'] == $subkriteria[0]['id_kriteria']) { echo "selected";} ?>>
                                    <?php echo $datakriteria['nama_kriteria']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="kode">Kode SuKriteria</label>
                    <div class="col-md-6">
                        <input value="<?php echo $subkriteria[0]['cu_subkriteria']; ?>" type="text" id="kode" name="kode" class="form-control" disabled>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="kategori">Kategori</label>
                    <div class="col-md-6">
                        <input value="<?php echo $subkriteria[0]['kategori']; ?>" type="text" id="kategori" name="kategori" class="form-control" placeholder="Nama Kategori">
                        <?= form_error('kategori', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="bobot">Bobot</label>
                    <div class="col-md-6">
                        <input value="<?php echo $subkriteria[0]['bobot']; ?>" type="number" id="bobot" name="bobot" class="form-control" placeholder="Nilai">
                        <?= form_error('bobot', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <br>
                <div class="row form-group justify-content-end">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-success btn-icon">
                            <span>Simpan</span>
                        </button>
                        <button type="reset" class="btn btn-warning btn-icon">
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