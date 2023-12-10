<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Alternatif</h1>
</div>
<div class="card shadow-lg mb-4 border-bottom-primary">
    <div class="table-responsive">
        <div class="card-header bg-white py-3">
            <div class="row">
                <div class="col">
                    <h4 class="h5 align-middle m-0 font-weight-bold text-dark">
                        <i class="fas fa-fw fa-table"></i> Data Alternatif
                    </h4>
                </div>
                <div class="col-auto">
                    <a href="<?= base_url('dataalternatif/add') ?>" class="btn btn-sm btn-success btn-icon-split">
                        <span class="icon">
                            <i class="fas fa-fw fa-plus"></i>
                        </span>
                        <span class="text">
                            Tambah Alternatif
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <table class="table table-striped" id="dataTable">
            <thead class="bg-dark text-white">
                <tr>
                    <th width="8%">No.</th>
                    <th>Nama Guru</th>
                    <th width="20%" class="text-center">Keterangan</th>
                    <th width="10%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($alternatif) :
                    foreach ($alternatif as $dataalternatif) :
                        ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $dataalternatif['nama']; ?></td>
                    <td class="text-center">
                        <a href="<?= base_url('dataalternatif/show/') . $dataalternatif['cu_alternatif']?>"
                            class="btn btn-sm btn-primary"><i class="fa fa-fw fa-eye"></i> Detail Informasi</a>
                    </td>
                    <td class="text-center">
                        <a href="<?= base_url('dataalternatif/edit/') . $dataalternatif['cu_alternatif'] ?>"
                            class="btn btn-circle btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></a>
                        <a onclick="return confirm('Yakin ingin menghapus data?')"
                            href="<?= base_url('dataalternatif/delete/') . $dataalternatif['cu_alternatif'] ?>"
                            class="btn btn-circle btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach;
                    else : ?>
                <tr>
                    <td colspan="10" class="text-center">Silahkan tambahkan data alternatif baru</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>