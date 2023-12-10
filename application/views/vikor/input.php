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
                </div>
            </div>
            <div class="card-body pb-2">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(); ?>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="tahun_akademik">Tahun Akademik</label>
                    <div class="col-md-6">
                        <select class="form-control" id="tahun_akademik" name="tahun_akademik">
                            <option>-- Pilih --</option>
                            <?php
                            $tempTahun = array();
                            foreach ($tahun_akademik as $data) {
                                if (!in_array($data['tahun_akademik'], $tempTahun)) {
                            ?>
                                    <option value='<?php echo $data['tahun_akademik']; ?>'><?php echo $data['tahun_akademik']; ?></option>
                            <?php
                                }
                                $tempTahun[] = $data['tahun_akademik'];
                            } ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row form-group justify-content-end">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon"><i class="fa fa-arrow-alt-circle-right"></i></span>
                            <span class="text">Proses Perhitungan Vikor</span>
                        </button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>