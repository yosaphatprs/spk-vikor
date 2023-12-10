<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm mb-4 border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form <?= $title; ?>
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('penilaian') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body pb-2">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(); ?>
                <input value="<?php echo $maxkriteria; ?>" type="text" id="maxkriteria" name="maxkriteria" class="form-control" hidden>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="tahun_akademik">Tahun Akademik</label>
                    <div class="col-md-6">
                        <input type="text" id="tahun_akademik" name="tahun_akademik" class="form-control" placeholder="Cth : 2018/2019">
                        <?= form_error('tahun_akademik', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="nis">NIS</label>
                    <div class="col-md-6">
                        <input type="text" id="nis" name="nis" class="form-control" placeholder="Nomor Induk Siswa" onchange="myChangeFunction(this)">
                        <?= form_error('nis', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="nama">Nama</label>
                    <div class="col-md-6">
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap Siswa" readonly>
                        <?= form_error('nama', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <?php $kodekriteria = 0;
                foreach ($kriteria as $datakriteria) {
                    $kodekriteria += 1;
                ?>
                    <div class="row form-group">
                        <input value="<?php echo $datakriteria['id_kriteria']; ?>" type="text" id="kriteria<?php echo $kodekriteria; ?>" name="kriteria<?php echo $kodekriteria; ?>" class="form-control" hidden>
                        <label class="col-md-4 text-md-right"><?php echo $datakriteria['nama_kriteria']; ?></label>
                        <div class="col-md-6">
                            <div class="row form-group">
                                <?php
                                $this->db->order_by('id_kriteria', 'ASC');
                                $this->db->where('id_kriteria', $datakriteria['id_kriteria']);
                                $subkriteria = $this->db->get('subkriteria');
                                if ($subkriteria->num_rows() <= 0) {
                                ?>
                                    <div class="col">
                                        <input type="text" id="nilaikriteria<?php echo $kodekriteria; ?>" name="nilaikriteria<?php echo $kodekriteria; ?>" class="form-control" placeholder="Nilai">
                                    </div>
                                <?php } else {
                                    $nilaiSub = $subkriteria->result_array(); ?>
                                    <div class="col">
                                        <select class="form-control" id="nilaikriteria<?php echo $kodekriteria; ?>" name="nilaikriteria<?php echo $kodekriteria; ?>">
                                            <option>- Pilih Nilai -</option>
                                            <?php foreach ($nilaiSub as $datasubkriteria) { ?>
                                                <option value='<?php echo $datasubkriteria['nilai']; ?>'><?php echo $datasubkriteria['nilai']; ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <br>
                <div class="row form-group justify-content-end">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon"><i class="fa fa-save"></i></span>
                            <span class="text">Simpan</span>
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            Reset
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