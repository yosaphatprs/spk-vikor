<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-info-circle"></i> Data Karyawan</h1>
</div>

<div class="row justify-content-center">
    <div class="col-md-12">
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
                            Form Data Diri Karyawan
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body pb-2">
                <?php foreach ($alternatif as $dataalternatif) : ?>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <tr>
                        <th class="bg-secondary text-light">NUPTK</th>
                        <td><?php echo $dataalternatif['cu_alternatif']; ?></td>
                    </tr>
                    <tr>
                        <th class="bg-secondary text-light">Nama Lengkap</th>
                        <td><?php echo $dataalternatif['nama']; ?></td>
                    </tr>
                    <tr>
                        <th class="bg-secondary text-light">Tempat, Tanggal Lahir</th>
                        <td><?php echo $dataalternatif['tempat_lahir']?>,<?= $dataalternatif['tanggal_lahir']; ?></td>
                    </tr>
                    <tr>
                        <th class="bg-secondary text-light">Jenis Kelamin</th>
                        <td><?php echo $dataalternatif['jenis_kelamin'] ?></td>
                    </tr>
                    <tr>
                        <th class="bg-secondary text-light">Pendidikan</th>
                        <td><?= $dataalternatif['pendidikan']; ?></td>
                    </tr>
                    <tr>
                        <th class="bg-secondary text-light">Pengalaman</th>
                        <td><?= $dataalternatif['pengalaman']; ?> Tahun</td>
                    </tr>
                    <tr>
                        <th class="bg-secondary text-light">Status</th>
                        <td><?= $dataalternatif['status']; ?></td>
                    </tr>
                    <tr>
                        <th class="bg-secondary text-light">Alamat</th>
                        <td><?= $dataalternatif['alamat']; ?></td>
                    </tr>
                </table>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>