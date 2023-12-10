<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg mb-4 border-bottom-primary">
            <div class="card-header bg-primary py-3">
                <div class="row">
                    <div class="col-auto">
                        <a href="<?= base_url('dataalternatif') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                    <label class="col-md-4 text-md-right" for="cu_alternatif">Nomor Induk Pegawai</label>
                    <div class="col-md-6">
                        <input type="text" id="cu_alternatif" name="cu_alternatif" class="form-control"
                            placeholder="Nomor Induk Pegawai">
                        <?= form_error('cu_alternatif', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="nama">Nama</label>
                    <div class="col-md-6">
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap Guru">
                        <?= form_error('nama', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="jenis_kelamin">Jenis Kelamin</label>
                    <div class="col-md-6">
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                            <option>-- Pilih Jenis Kelamin --</option>
                            <option value='Laki-Laki'>Laki-Laki</option>
                            <option value='Perempuan'>Perempuan</option>
                        </select>
                        <?= form_error('jenis_kelamin', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="tempat_lahir">Tempat Lahir</label>
                    <div class="col-md-6">
                        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control"
                            placeholder="Tempat Lahir">
                        <?= form_error('tempat_lahir', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="tanggal_lahir">Tanggal Lahir</label>
                    <div class="col-md-6">
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control"
                            placeholder="Tanggal Lahir">
                        <?= form_error('tanggal_lahir', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="pendidikan">Pendidikan</label>
                    <div class="col-md-6">
                        <select class="form-control" id="pendidikan" name="pendidikan">
                            <option>-- Pilih Pendidikan --</option>
                            <option value='SMA/SMK'>SMA/SMK Sederajat</option>
                            <option value='S1'>S1</option>
                            <option value='S2'>S2</option>
                            <option value='S3'>S3</option>
                        </select>
                        <?= form_error('pendidikan', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="pengalaman">Pengalaman</label>
                    <div class="col-md-6">
                        <input type="number" step="0.1" id="pengalaman" name="pengalaman" class="form-control"
                            placeholder="Lama Pengalaman Kerja">
                        <?= form_error('pengalaman', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                    Tahun
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="status_menikah">Status</label>
                    <div class="col-md-6">
                        <select class="form-control" id="status_menikah" name="status_menikah">
                            <option>-- Pilih Status --</option>
                            <option value='Belum Menikah'>Belum Menikah</option>
                            <option value='Menikah'>Sudah Menikah</option>
                        </select>
                        <?= form_error('status_menikah', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="alamat">Alamat</label>
                    <div class="col-md-6">
                        <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat">
                        <?= form_error('pengalaman', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group justify-content-end">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-success btn-sm">
                            <span>Simpan</span>
                        </button>
                        <button type="reset" class="btn btn-warning btn-sm">
                            <span>Reset</span>
                        </button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>