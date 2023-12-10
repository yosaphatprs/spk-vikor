<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Kriteria</h1>
</div>
<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm mb-4 border-bottom-info">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-dark">
                <i class="fas fa-table"></i> Data Kriteria
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('datakriteria/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fas fa-fw fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Kriteria
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="bg-dark text-white">
                <tr>
                    <th width="30">No.</th>
                    <th>Kode Kriteria</th>
                    <th>Nama Kriteria</th>
                    <th>Bobot</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($kriteria) :
                    foreach ($kriteria as $datakriteria) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $datakriteria['id_kriteria']; ?></td>
                            <td><?= $datakriteria['nama_kriteria']; ?></td>
                            <td><?= $datakriteria['bobot']; ?></td>
                            <td>
                                <a href="<?= base_url('datakriteria/edit/') . $datakriteria['id_kriteria'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                <a onclick="return confirm('Yakin ingin menghapus data?')" href="<?= base_url('datakriteria/delete/') . $datakriteria['id_kriteria'] ?>" class="btn btn-sm btn-danger" ><i class="fa fa-fw fa-trash"></i> Hapus</a>
                           </td>
                        </tr>
                    <?php endforeach;
                else : ?>
                    <tr>
                        <td colspan="8" class="text-center">Silahkan tambahkan data kriteria baru</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(function (){
  $('[data-toggle="tooltip"]').tooltip()

})
</script>