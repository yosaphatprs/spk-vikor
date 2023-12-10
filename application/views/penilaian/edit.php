<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg mb-4 border-bottom-primary">
            <div class="card-header bg-primary py-3">
                <div class="row">
                    <div class="col-auto">
                        <a href="<?= base_url('penilaian') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <input type="text" id="cu_alternatif" name="cu_alternatif" class="form-control"
                    placeholder="Masukkan Id Alternatif" value="<?php echo $alternatif[0]['cu_alternatif'] ?>" hidden>
                <input value="<?php echo $maxkriteria; ?>" type="text" id="maxkriteria" name="maxkriteria"
                    class="form-control" hidden>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="nama">Nama Guru</label>
                    <div class="col-md-6">
                        <input type="text" id="nama" name="" class="form-control" placeholder="nama Alternatif"
                            value="<?= $alternatif[0]['nama'] ?>" readonly>
                        <?= form_error('nama', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <?php $kodekriteria = 0;
                $indexKdKriteria = 0;
                foreach ($kriteria as $datakriteria) {
                    $kodekriteria += 1;
                ?>
                <div class="row form-group">
                    <input value="<?php echo $datakriteria['id_kriteria']; ?>" type="text"
                        id="kriteria<?php echo $kodekriteria; ?>" name="kriteria<?php echo $kodekriteria; ?>"
                        class="form-control" hidden>
                    <label
                        class="col-md-4 text-md-right"><?php echo $datakriteria['nama_kriteria'] . " (K" . $kodekriteria . ")"; ?></label>
                    <div class="col-md-6">
                        <div class="row form-group">
                            <div class="col">
                                <input class="form-control" type="text" id="nilaikriteria<?php echo $kodekriteria; ?>"
                                    name="nilaikriteria<?php echo $kodekriteria; ?>"
                                    value="<?php echo $penilaian[$indexKdKriteria]['nilai']; $indexKdKriteria+=1 ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <br>
                <div class="row form-group justify-content-end">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-success">
                            <span class="text">Simpan</span>
                        </button>
                        <button type="reset" class="btn btn-warning">
                            <span class="text">Reset</span>
                        </button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function myChangeFunction(input1) {
    var jArray = <?php echo json_encode($siswa); ?>;

    for (var i = 0; i < jArray.length; i++) {
        if (jArray[i]['nis'] == input1.value) {
            var input2 = document.getElementById('nama');
            input2.value = jArray[i]['nama'];
        }
    }
}
</script>